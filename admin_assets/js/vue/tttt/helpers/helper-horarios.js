

//  addTime('2018-05-03',{hours: 5, minutes: 5, seconds: 5});
/**
 * Soma tempo em uma data
 * @param {[data]}      data   - a data em que será somado o tempo
 * @param {[object]}    config - {hours: 5, minutes: 5, seconds: 5}
 * @return {string}             [string formatada "YYYY-MM-DD HH:mm:ss"]
 *
 * Exemplo:
 * addTime('2018-05-03',{hours: 5, minutes: 5, seconds: 5});
 *
 */
function addTime(data, config){

    return  moment(data)
            .add(config )
            .format("YYYY-MM-DD HH:mm:ss");
}


/**
 * Verifica se a data está entre um intervalo de tempo
 *
 * @param  {[type]}  date   [data a ser verificada]
 * @param  {[type]}  inicio [inicio do intervalo]
 * @param  {[type]}  fim    [fim do intervalo]
 * @return {Boolean}
 *
 * isBetwin('07:34:00', '08:34:00', '10:34:00');
 *
 */
function isBetwinTime(date, inicio, fim, incluirUltimoHoHorario){

    var format = 'hh:mm:ss'

    var time = moment(date,format),
    beforeTime = moment(inicio, format),
    afterTime = moment(fim, format);

    var indicadorDeInclusao = ( incluirUltimoHoHorario == false ) ? '[)' : '[]';

    if (time.isBetween(beforeTime, afterTime, null, indicadorDeInclusao)) {
        return true
    }

    return false;

}

/**

    gerarListaDehorarios({
        hours: 30,
        minutes: 30,
        seconds: 30,
        startInterval: '2016-10-30 00:00',
        endInterval: '2016-10-30 23:59',
        format: 'HH:mm'
    });

 */
function gerarListaDehorarios(config){

    var startTime  = config.startInterval;
    var horarios = [];

    while( moment( startTime ).isBetween( config.startInterval, config.endInterval, null, '[]') ){

        var inicioIntervalo = moment( startTime ).format( config.format );
        var fimIntervalo    = addTime(startTime, { minutes: config.minutes });

        var startTime = fimIntervalo;

        horarios.push({
            inicioIntervalo: inicioIntervalo,
            fimIntervalo: moment( fimIntervalo ).format( config.format ) ,
        });

    }

    return horarios;

}

function gerarIntervalosGrade(){
    log('GERAR INTERVALOS GRADE');
    var dia = moment( new Date() ).format('YYYY-MM-DD');
    var inicioDia = dia + ' 07:00:00';
    var fimDia = dia + ' 18:00:00';

    var horariosGrade = gerarListaDehorarios({
        hours: 30,
        minutes: 30,
        seconds: 30,
        startInterval: inicioDia,
        endInterval: fimDia,
        format: 'HH:mm'
    });

    return horariosGrade;
}



// Adiciona os horários da clínica nos intervalos da grade
function adicionarHorariosParaIntervaloGrade( horariosGrade, horariosClinica ){

    log('ADICIONAR HORARIOS PARA INTERVALO GRADE')

    var qtHorariosGrade = horariosGrade.length;
    var qtHorariosClinica = horariosClinica.length;

    for (var i = 0; i < qtHorariosGrade; i++) {

        horariosGrade[i].horariosClinica = [];

        var inicioIntervalo  = horariosGrade[i].inicioIntervalo;
        var fimIntervalo     = horariosGrade[i].fimIntervalo;
        var incluirUltimo    = ( i == qtHorariosGrade - 1 ) ? true : false ;

        for (var j = 0; j < qtHorariosClinica; j++) {

            if( isBetwinTime(horariosClinica[j].inicio, inicioIntervalo, fimIntervalo, incluirUltimo) ){
                horariosGrade[i].horariosClinica.push(horariosClinica[j])
            }

        }

    }

    return horariosGrade;
}


function montarGrade( intervalosGrade, profissionais, horariosClinica ){

    console.log('MONTAR GRADE')

    var qtHorariosGrade = intervalosGrade.length;

    for (var i = 0; i < qtHorariosGrade; i++) {

        var inicioIntervalo  = intervalosGrade[i].inicioIntervalo;
        var fimIntervalo     = intervalosGrade[i].fimIntervalo;
        var incluirUltimo    = ( i == qtHorariosGrade - 1 ) ? true : false ;

        intervalosGrade[i].profissionais = [];

        for (var j = 0; j < profissionais.length; j++) {

            var atendimentos = pegarAtendimentosDoIntervalo( profissionais[j].atendimentos, inicioIntervalo, fimIntervalo, incluirUltimo )
            var merge = mergeHorarios(intervalosGrade[i].horariosClinica, atendimentos);

            var p = {
                nm_profissional: profissionais[j].nm_profissional,
                id_profissional: profissionais[j].id_profissional,
                atendimentos: atendimentos,
                itens: merge
            }
            intervalosGrade[i].profissionais.push( p );
        }

    }

    return intervalosGrade;
}

function pegarHorariosDoIntervalo(horarios, inicioIntervalo, fimIntervalo, incluirPrimeiroHorario){

    var novo = [];

    horarios.forEach(function(item){

        if( isBetwinTime( item.inicio, inicioIntervalo, fimIntervalo, incluirPrimeiroHorario) ){
            novo.push( item ) ;
        }

    });

    return novo;
}

function pegarAtendimentosDoIntervalo( atendimentos, inicioIntervalo, fimIntervalo, incluirPrimeiroHorario ){

    var novo = [];

    atendimentos.forEach(function(atendimento){

        var inicio_agendamento = moment( atendimento.inicio_agendamento ).format( 'HH:mm' );

        if( isBetwinTime( inicio_agendamento, inicioIntervalo, fimIntervalo, incluirPrimeiroHorario) ){
            novo.push( atendimento ) ;
        }

    });

    return novo;
}

// =======================================================
//
//

function mergeHorarios(horariosClinica, atendimentos){

    // var horarios    = JSON.parse( JSON.stringify( data.horariosClinica ));
    // var atendimento = JSON.parse( JSON.stringify( data.profissionaisClinica[0].atendimentos  ))

    var horarios    = JSON.parse( JSON.stringify( horariosClinica ));
    var atendimento = JSON.parse( JSON.stringify( atendimentos  ))

    var mergeado = [];

    // function make(h, atendimento){

    //     return {
    //         inicio: h.inicio,
    //         fim: h.fim,
    //         atendimento: atendimento
    //     };

    // }

    var remover = false;

    for (var i = horarios.length - 1; i >= 0; i--) {

        for (var j = atendimento.length - 1; j >= 0; j--) {

            var horario  = moment( atendimento[j].inicio_agendamento ).format('HH:mm:ss');

            if( horario == horarios[i].inicio ){

                // mergeado.push( make(horarios[i], atendimento[j]) );
                mergeado.push( padronizarObjetoAtendimento(atendimento[j]) );

                atendimento.splice(j, 1);
                remover = true;

            }

        }

        if( remover == true ){
            // console.log( 'REMOVER - 1: ' + horarios[i].inicio )
            horarios.splice(i, 1);
            remover = false;
        }

    }

    for (var i = horarios.length - 1; i >= 0; i--) {

        // mergeado.push( make( horarios[i], '') );
        mergeado.push( padronizarObjetoAtendimento('', horarios[i]) )
        horarios.splice(i, 1);

    }

    for (var i = atendimento.length - 1; i >= 0; i--) {

        // var novo = {
        //     inicio: moment( atendimento[i].inicio_agendamento ).format('HH:mm:ss'),
        //     fim: moment( atendimento[i].fim_agendamento ).format('HH:mm:ss'),
        // }

        // mergeado.push( make(novo, atendimento[i]) );

        mergeado.push( padronizarObjetoAtendimento(atendimento[i]) );

        atendimento.splice(i, 1);

    }

    mergeado.sort(function (a, b) {
        return new Date('1970/01/01 ' + a.inicio) - new Date('1970/01/01 ' + b.inicio);
    });

    return mergeado;

}


function padronizarObjetoAtendimento(atendimento, horario){

    if( typeof atendimento == 'undefined' || atendimento == '' ){
        atendimento = '';
        var inicio  =  horario.inicio;
        var fim     =  horario.fim;
    }else{
        var inicio  =  atendimento.inicio_agendamento;
        var fim     =  atendimento.fim_agendamento;
    }

    return {
        inicio: inicio,
        fim: fim,
        atendimento: atendimento
    };


}
