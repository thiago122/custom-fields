
var PreviewPacienteAtendimento = Vue.extend({

    template: "\n    <div class=\"clearfix preview is-paciente\">\n\n        <div class=\"preview__avatar is-paciente\">\n            <img class=\"preview__avatar-image img-circle\" :src=\"atendimento.agendante.avatar.mini\" >\n            <button\n                class=\"btn btn-xs btn-danger preview__btn-excluir\"\n                v-if=\"atendimento.id_atendimento && atendimento.modoEdicao\"\n                @click=\"remover()\"\n                >\n                Excluir\n            </button>\n        </div>\n\n        <div class=\"preview__info-col\">\n            <b>{{atendimento.agendante.nm_usuario}}</b><br>\n            CPF: {{atendimento.agendante.cpf}}<br>\n            Celular: {{atendimento.agendante.celular}}\n        </div>\n\n        <div class=\"preview__info-col\">\n            <span v-if=\"atendimento.agendante.rg\">RG: {{atendimento.agendante.rg}}</span><br>\n            <span v-if=\"atendimento.agendante.fixo\">Fixo: {{atendimento.agendante.fixo}}</span>\n        </div>\n\n        <div class=\"preview__label is-paciente\">Paciente</div>\n\n    </div>\n\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    computed: {

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        }

    },

    methods: {

        remover: function(){
            this.$store.dispatch('RESET_AGENDANTE_ATENDIMENTO');
        }

    }

});

Vue.component('PreviewPacienteAtendimento', PreviewPacienteAtendimento);
