
var PreviewPreCadastroPaciente = Vue.extend({

    template: "<div class=\"clearfix preview is-paciente\">\n\n    <div class=\"row\">\n        <div class=\"col-md-12\">\n            <b>Nome:</b> {{atendimento.agendante.nm_usuario}}\n        </div>\n\n    </div>\n    <div class=\"row\">\n        <div class=\"col-md-12\">\n            <b>Telefone:</b> {{atendimento.agendante.celular}}\n        </div>\n    </div>\n    <div class=\"preview__label is-paciente\">Pré-cadastro</div>\n</div>\n",

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

Vue.component('PreviewPreCadastroPaciente', PreviewPreCadastroPaciente);
