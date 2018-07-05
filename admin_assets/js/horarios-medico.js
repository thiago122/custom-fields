
(function () {

    var data = {
        profissional_id:   $('[name=profissional_id]').val(),
        clinica_id:        $('[name=clinica_id]').val(),
    }

    // var diasSemana = {
    //     seg:    [],
    //     terca:  [],
    //     quarta: [],
    //     quinta: [],
    //     sexta:  [],
    //     sabado: [],
    //     domingo:[],
    // }


    var service = {

        save: function(url, data){
            return $.post(url, data);
        },

        remove: function(url, data){
            return $.post(url, data);
        },

        list: function(data){
            return $.getJSON(base_url + 'admin/Clinica/horariosMedico/' + data.clinica_id + '/' + data.profissional_id );
        }

    }

    function save(e){

        e.preventDefault();

        var serializedData = $(this).serializeArray()
        var url = $(this).attr('action');

        var request = service.save(url, serializedData)

        request.done(function(data){
            sucessMessage(data)
            list();
        });

        request.fail(failMessage)

    }

    function remove(e){
        e.preventDefault();

        var serializedData = $(this).serializeArray()
        var url = $(this).attr('action');

        var request = service.remove(url, serializedData)

        request.done(function(data){
            sucessMessage(data)
            list();
        });
        request.fail(failMessage)
    }

    function list(){

        if( typeof data.clinica_id == 'undefined' || typeof data.profissional_id == 'undefined'){
            return false;
        }

        var request = service.list(data);

        request.done(function(data){

            $('.sys-calendario-horarios').html('');

            setOnScreen('Segunda',  data.horarios.segunda);
            setOnScreen('Terça',    data.horarios.terca);
            setOnScreen('Quarta',   data.horarios.quarta);
            setOnScreen('Quinta',   data.horarios.quinta);
            setOnScreen('Sexta',    data.horarios.sexta);
            setOnScreen('Sábado',   data.horarios.sabado);
            setOnScreen('Domingo',  data.horarios.domingo);
        });

        request.fail(failMessage)
    }

    function setOnScreen(dia, dados){
        var html = '';
        html += '<div class="dia">';
        html += '<h5>'+ dia +'</h5>'
        html += '<ul>';

        dados.forEach(function( horario ){
            html += '<li>';

            html += ' <div class="separador">';

            html += '   <div class="checkbox">';
            html += '     <label>';
            html += '       <input type="checkbox" name="horarios[]" value="'+ horario.id_horario_disponivel +'">';
            html +=             horario.nm_especialidade
            html += '     </label>';
            html += '   </div>';
            html += ' </div><!-- /separador -->';

            html += '<span class="text-red">'+ horario.hora +'</span> - ';
            html += ' ' +horario.nm_tipo_especialidade  ;


            html += '</li>';
        })

        html += '</li>';
        html += '</ul>';
        html += '</div>';
        $('.sys-calendario-horarios').append(html)
    }

    function failMessage(jqXHR, textStatus){

        if( $.isArray( jqXHR.responseJSON.msg ) ){
            jqXHR.responseJSON.msg.forEach(function(msg){
                mensagem(msg, 'danger')
            })

        }else{
            mensagem(jqXHR.responseJSON.msg, 'danger')
        }

    }

    function sucessMessage(response){
        if( $.isArray( response.msg ) ){
            response.msg.forEach(function(msg){
                mensagem(msg, 'success')
            })

        }else{
             mensagem(response.msg, 'success')
        }
    }

    $('#sys-form-horarios').submit(save);
    $('#sys-form-rm-horario').submit(remove);

    if ($('.sys-calendario-horarios').length > 0){
        list();
    }
    

})();
