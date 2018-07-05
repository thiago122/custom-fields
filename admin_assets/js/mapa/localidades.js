var localidades = localidades || {}

localidades.controller = {

    mostrarCidadades: function(callbackSuccess){

        var idEstado = $('.select-estado').val();
        var cidades = localidades.service.getCidadesPorIdEstado(idEstado);

        localidades.ui.setLoadingOnSelect('.select-cidade');

        cidades.done(function(listaDeCidades){

            if(listaDeCidades.length > 0){

                localidades.ui.setSelectOptions.cidade(listaDeCidades);

                localidades.ui.reset.bairro()
                localidades.ui.reset.logradouro()
                // localidades.ui.reset.numero()
                localidades.ui.reset.complemento()
                // localidades.ui.reset.cep()

                if( typeof callbackSuccess  === "function" ){
                    callbackSuccess(listaDeCidades);
                }

                return true;
            }

            localidades.ui.setLoadingOnSelect('.select-cidade','Não existem cidades.');

        });

    },

    mostrarBairros: function(callbackSuccess){

        var idCidade = $('.select-cidade').val();
        var bairros = localidades.service.getBairrosPorIdCidade(idCidade);

        localidades.ui.setLoadingOnSelect('.select-bairro');

        bairros.done(function(listaDeBairros){

            if(listaDeBairros.length > 0){

                localidades.ui.setSelectOptions.bairro(listaDeBairros);

                localidades.ui.reset.logradouro()
                // localidades.ui.reset.numero()
                localidades.ui.reset.complemento()
                // localidades.ui.reset.cep()

                // pesquisaEnderecoMapa()

                if( typeof callbackSuccess  === "function" ){
                    callbackSuccess(listaDeBairros)
                }

                return true;
            }

            localidades.ui.setLoadingOnSelect('.select-bairro','Não existem bairros.');


        });

    },

    buscaCep: function(){

        var cep = $('.input-cep').val();

        var endereco = localidades.service.getEnderecoPorCEP(cep);

        localidades.ui.toggleBtnCep();

        endereco.done(function(end){

            localidades.ui.toggleBtnCep();

            if(end !== 0){

                end.cidade;
                end.bairro;
                end.cep;
                end.uf;

                console.log(end)

                localidades.ui.setSelected.estado(end.uf);

                var enderecoSalvo = localidades.service.salvarEndereco(end);

                enderecoSalvo.done(function(){
                    localidades.controller.mostrarCidadades(function(){

                        localidades.ui.setSelected.cidade(end.cidade);

                        localidades.controller.mostrarBairros(function(){

                            localidades.ui.setSelected.bairro(end.bairro);

                            localidades.ui.setValue.logradouro(end.endereco);
                            localidades.ui.setValue.cep(end.cep);
                            // pesquisaEnderecoMapa()
                        });

                    });
                })

            }else{
                alert('Não encontramos o endereço')
            }

        });
    },

    initEndereco: function(){

        localidades.controller.mostrarCidadades(function(){

            var selectCidade = $(".select-cidade");

            if( typeof selectCidade == 'undefined' ){
                return false;
            }

            var idCidade = selectCidade.attr('data-id');
            selectCidade.val(idCidade);

            localidades.controller.mostrarBairros(function(){
                var selectBairro = $(".select-bairro");
                var idCidade = selectBairro.attr('data-id');
                selectBairro.val(idCidade);
            });

        });
    }
}

localidades.ui = {

    setSelected: {
        estado: function (uf){
            ui.form.select.selecionar('.select-estado', uf);
        },
        cidade: function (nmCidade){
            ui.form.select.selecionar('.select-cidade', nmCidade);
        },
        bairro: function (nmbairro){
            ui.form.select.selecionar('.select-bairro', nmbairro);
        }
    },

    setValue: {
        logradouro: function(logradouro){
            ui.form.text.setValue('.lograrouro',logradouro);
        },
        numero: function(numero){
            ui.form.text.setValue('.numero',numero);
        },
        complemento: function(complemento){
            ui.form.text.setValue('.complemento',complemento);
        },
        cep: function(cep){
            ui.form.text.setValue('.input-cep',cep);
        },
    },

    setSelectOptions: {
        cidade: function (ObjCidades){
            var options = ui.form.select.gerar(ObjCidades, 'id_cidade', 'nm_cidade');
            $('.select-cidade').html(options);
        },
        bairro: function (objBairros){
            var options = ui.form.select.gerar(objBairros, 'id_bairro', 'nm_bairro');
            $('.select-bairro').html(options);
        }
    },

    setLoadingOnSelect: function(seletor, text = 'Buscando...'){
        $(seletor).html('<option value="">'+ text +'</option>')
    },

    reset: {
        cidade: function (){
            ui.form.select.reset('.select-cidade');
        },
        bairro: function (){
            ui.form.select.reset('.select-bairro');
        },
        logradouro: function (){
            ui.form.text.reset('.endereco');
        },
        numero: function (){
            ui.form.text.reset('.numero');
        },
        complemento: function (){
            ui.form.text.reset('.complemento');
        },
        cep: function (){
            ui.form.text.reset('.input-cep');
        },
    },

    toggleBtnCep: function(){
        ui.all.toggleText('.btn-cep','...');
    }
}


localidades.service = {

    getBairrosPorIdCidade: function(idCidade){
        return cidades = $.ajax({
            url: base_url + 'admin/Bairro/',
            type: "GET",
            dataType: 'json',
            data: {id_cidade:idCidade },
        })
    },

    getCidadesPorIdEstado: function(idEstado){

        return $.ajax({
            url: base_url + 'admin/Cidade/',
            type: "GET",
            dataType: 'json',
            data:  {id_estado:idEstado },
        })
    },

    // NÃO USADO
    getCidadesPorSiglaEstado: function(sigla){
        return $.ajax({
            url: base_url + 'admin/Cidade' + sigla,
            type: "GET",
            dataType: 'json'
        })
    },

    // NÃO USADO
    verificarEnderecoExiste: function(idEstado){
        return $.ajax({
            url: base_url + 'admin/cidadeBySiglaEstado/' + idEstado,
            type: "POST",
            dataType: 'json'
        })
    },

    // NÃO USADO
    getEnderecoPorCEP: function(cep){
        return $.ajax({
            url: 'https://clareslab.com.br/ws/cep/json/'+ cep +'/',
            type: "POST",
            dataType: 'json'
        })
    },


    salvarEndereco(endereco){

        var dados = {
            siglaEstado : endereco.uf,
            cidade: endereco.cidade,
            bairro: endereco.bairro
        }

        return $.ajax({
            url: base_url + 'ajax/salvarEndereco/',
            type: "POST",
            dataType: 'json',
            data: dados
        });
    }
}

//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------


$(document).ready(function(){
    $('.select-estado').change(localidades.controller.mostrarCidadades);
    $('.select-cidade').change(localidades.controller.mostrarBairros);
    $('body').on('click','.btn-cep', localidades.controller.buscaCep );

    localidades.controller.initEndereco();


});