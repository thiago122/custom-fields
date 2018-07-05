

var configRecepcao = Vue.extend({

    template: "<span class=\"dropdown dd-config-atendimento\">\n\n    <a class=\"btn btn-xs btn-primary\" id=\"dd-config-atendimento\" data-target=\"#\" href=\"http://example.com\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">\n\n        {{dadosBasicos.dataAtual}}\n\n        <span v-if=\"clinicaSelecionada\">{{clinicaSelecionada.nm_clinica}}</span>\n\n        <span class=\"caret\"></span>\n    </a>\n\n    <div class=\"dropdown-menu \" aria-labelledby=\"dd-config-atendimento\">\n\n        <div style=\"width: 300px; padding: 10px\">\n            <div class=\"form-group\">\n                <label>Data</label>\n                <div class=\"input-group date\">\n                    <div class=\"input-group-addon\">\n                        <i class=\"fa fa-calendar\"></i>\n                    </div>\n                    <!-- <input type=\"text\" name=\"dia\" class=\"form-control input-sm vdate datepicker\" v-model=\"config.dataAtual\"> -->\n                    <input type=\"text\" name=\"dia\" class=\"form-control input-sm vdate \" v-model=\"dadosBasicos.dataAtual\">\n                </div>\n            </div><!-- /form-group -->\n\n            <div class=\"form-group\">\n                <label>Clínica</label>\n\n                <select class=\"form-control input-sm\" v-model=\"clinica.idClinica\" @change=\"getAtendimentosDia\">\n                    <option ></option>\n                    <option v-for=\"option in dadosBasicos.clinicas\"  :value=\"option.id_clinica\">{{ option.nm_clinica }} </option>\n                </select>\n            </div><!-- /form-group -->\n\n        </div>\n\n    </div>\n\n</span>\n\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    mounted: function(){

        $('.dd-config-atendimento .dropdown-menu').click(function(e) {
            e.stopPropagation();
        });

    },

    computed: {

        dadosBasicos: function(){
            return this.$store.state.recepcao.dadosBasicos;
        },

        clinica: function(){
            return this.$store.state.recepcao.clinica;
        },

        clinicaSelecionada: function(){

            var self = this

            clinica = _.find(this.dadosBasicos.clinicas, function(o) {
                return o.id_clinica == self.clinica.idClinica;
            });

            return clinica
        }
    },

    methods: {

        getAtendimentosDia: function(){

            logProcesso('LISTAR ATENDIMENTOS DO DIA');

            $('.dd-config-atendimento').removeClass('open')

            var self = this;

            this.$store.dispatch('FETCH_ATENDIMENTOS_DIA')
            .then(function(response){

                self.$emit('clinica-selecionada');

            }, function(error) {
                //alert('erro');
            });

        },

    }

});

Vue.component('configRecepcao', configRecepcao);
