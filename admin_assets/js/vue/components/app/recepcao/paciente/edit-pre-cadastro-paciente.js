
var EditPreCadastroPaciente = Vue.extend({

    template: "\n<div class=\"clearfix preview is-paciente\">\n    <div class=\"row\">\n        <div class=\"col-md-6\">\n            <label>Nome</label>\n            <input type=\"text\" class=\"form-control input-sm\" placeholder=\"Nome\" v-model=\"atendimento.agendante.nm_usuario\">\n        </div>\n        <div class=\"col-md-6\">\n            <label>Telefone</label>\n            <input type=\"text\" class=\"form-control input-sm\" placeholder=\"Telefone\" v-model=\"atendimento.agendante.celular\">\n        </div>\n    </div>\n    <div class=\"preview__label is-paciente\">Pré-cadastro</div>\n</div>\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    computed: {

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        }

    },

    methods: { }

});

Vue.component('EditPreCadastroPaciente', EditPreCadastroPaciente);
