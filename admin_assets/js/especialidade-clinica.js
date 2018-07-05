/* -------------------------------------------- */
/* AUTOCOMPLETE  Profissional-clinica           */
/* -------------------------------------------- */

function loadEspecilidadesMedico(){

    var el = $(this);
    getEspecilidadesmedico(el)

}

function initLoadEspecilidadesMedico(){
    var el = $('#autocomplete-profissional');

    if(  el.length > 0 ){
        getEspecilidadesmedico(el)
    }

}

function getEspecilidadesmedico(el){

    var idProfissional = el.val();

    if(idProfissional == ''){
        return false;
    }

    var idClinica = el.attr('data-clinica');
    var request = $.getJSON( base_url + 'admin/Profissional/especialidadesProfissionalClinica/' + idProfissional + '/' + idClinica );

    request.done(function(dados){

        var html = '<p>Sem especialidades</p>';

        if( dados.length > 0 ){
            html = '';
        }

        html += '<table class="table">';

        dados.forEach(function(especialidade){
            html += gerarLinhaEspecialidadeClinica( especialidade, idClinica, idProfissional );
        });

        html += '</table>';

        $('.sys-especialidades-profissional').html(html);

    });
}

function gerarLinhaEspecialidadeClinica( especialidade, idClinica, idProfissional ){

    var html = '';

    var id          = 'linha-'+ especialidade.id_especialidade + '-' + idClinica + '-' + idProfissional;
    var estado      = ' desabilitado ';
    var cssClass    = ' btn-default ';
    var icon        = ' glyphicon-ok ';
    var iconText    = ' adicionar ';
    var actionClass = ' sys-adicionar';

    if( especialidade.existe == '1' ){

        estado      = ' indisponível ' ;
        cssClass    = ' btn-danger ';
        icon        = ' glyphicon-ok ';
        iconText    = ' adicionar ';
        actionClass = ' sys-habilitar';

        if( especialidade.disponivel == '1' ){
            estado      = ' Disponível ';
            cssClass    = ' btn-success ' ;
            icon        = ' glyphicon-remove ';
            iconText    = ' remover ';
            actionClass = ' sys-remover';

        }
    }

    html += '<tr id="'+ id +'" data-especialidade="'+ especialidade.id_especialidade +'" data-clinica="'+ idClinica +'" data-profissional="'+ idProfissional +'">';
    html += '   <td>';
    html += '       <button type="button" class="btn  btn-xs '+ actionClass +'"> '+ iconText +' <span class="glyphicon '+ icon +'"></span></button>';
    html += '   </td>';
    html += '   <td>';
    html += '       <spam class="btn btn-xs '+ cssClass +'">'+ estado +'</spam>';
    html += '   </td>';
    html += '   <td>';
    html += '       <button type="button" class="btn  btn-xs"> Horários </button>';
    html += '   </td>';
    html += '   <td>'+ especialidade.nm_especialidade +'</td>';
    html += '</tr>';

    return html;
}


// ----------------------------------------------------------------------

function adicionarProfissionalClinica(){

    var el = $(this);
    var request = $.post( base_url + 'admin/Clinica/storeProfissional/', getData(el));

    request.done(function(data){
        replace( el, data.especialidade );
        mensagem(data.msg, 'success');
    });

}

function habilitarProfissionalClinica(){

    var el      = $(this);
    var request = $.post( base_url + 'admin/Clinica/habilitarProfissional/', getData(el));

    request.done(function(data){
        console.log(data)
    });

}

function removerProfissionalClinica(){
    console.log( ' removerProfissional ' );
    var el      = $(this);
    var request = $.post( base_url + 'admin/Clinica/removerProfissional/', getData(el));

    request.done(function(data){
        replace( el, data.especialidade );
        mensagem(data.msg, 'success');
    });

}

function replace( el, especialidade ){

    var dados   = getData(el);
    var html    = gerarLinhaEspecialidadeClinica( especialidade, dados.id_clinica , dados.id_profissional );
    el.parents('tr').replaceWith( html );

}

function getData(el){

    return {
        id_especialidade:   el.parents('tr').attr('data-especialidade'),
        id_profissional:    el.parents('tr').attr('data-profissional'),
        id_clinica:         el.parents('tr').attr('data-clinica'),
    }

}


/* -------------------------------------------- */
/* -------------------------------------------- */
/* -------------------------------------------- */

$(document).ready(function(){
    $('body').on('click','.sys-adicionar', adicionarProfissionalClinica);
    $('body').on('click','.sys-habilitar', removerProfissionalClinica);
    $('body').on('click','.sys-remover', removerProfissionalClinica);

    $('#autocomplete-profissional').change( loadEspecilidadesMedico )

    initLoadEspecilidadesMedico()
});
