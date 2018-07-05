var ui = ui || {};

ui.form = {

    select: {

        gerar: function (values, val, text){

            html = '<option value="">Escolha</option>';
            var total = values.length;

            for (var i = 0; i < total; i++) {
                html += '<option value="'+ values[i][val] +'">'+ values[i][text] +'</option>'
            }

            return html;
        },

        selecionar: function(seletor, text){
            console.log(seletor + ' - ' + text)
            $( seletor +" option:contains(" + text +")").attr('selected', true);
        },

        reset: function(seletor){
            $( seletor ).html(' ');
        },

        setLoading: function(seletor, text = 'Buscando...'){
            $(seletor).html('<option value="">'+ text +'</option>')

        },

    },

    text: {

        setValue: function(seletor, valor){
            $(seletor).val(valor);
        },

        reset: function(seletor){
            $( seletor ).val('');
        }
    },

    reset: function(seletorDoFormulario ){

        if(typeof seletorDoFormulario !== "undefined"){
            $(seletorDoFormulario)[0].reset();
        }
    }
}

ui.all = {

    toggleText: function(seletor, toggleText){

        var el = $( seletor );
        var attrText = el.attr('data-toggle-text');

        if(typeof attrText !== "undefined"){

            var elText = el.text()
            var attrText = el.attr('data-toggle-text');

            el.attr('data-toggle-text',elText);
            el.text(attrText);
        }else{

            var elText = el.text()
            el.attr('data-toggle-text',elText);
            el.text(toggleText);
        }

    },

    toggleValue: function(seletor, toggleText){

        var el = $( seletor );
        var attrText = el.attr('data-toggle-text');

        if(typeof attrText !== "undefined"){

            var elText = el.val()
            var attrText = el.attr('data-toggle-text');

            el.attr('data-toggle-text',elText);
            el.val(attrText);

        }else{

            var elText = el.val()

            el.attr('data-toggle-text',elText);
            el.val(toggleText);

        }

    },

    setLoading: function(seletor){

        var html = '';

        html += '<div class="container">';
            html += '<div class="row">';
                html += '<h3>Aguarde...</h3>';
                html += '<div class="progress progress-striped active page-progress-bar">';
                    html += '<div class="progress-bar" style="width: 100%;"></div>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        $(seletor).html(html);

    },

}

ui.components = {

    alert: function(mensagem, tipo){

        if( typeof mensagem === 'undefined' ){
            var mensagem = '';
        }

        if( typeof tipo === 'undefined' ){
            var tipo = 'success';
        }

        $.notify(

            {
                message: mensagem
            },

            {
                type: tipo,
                z_index: 9999
            }
        );

    }

}
