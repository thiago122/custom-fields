
var PreviewProfissionalAtendimento = Vue.extend({

    template: "\n<div class=\"clearfix preview is-profissional\">\n    <div class=\"preview__avatar is-profissional\">\n        <img class=\"preview__avatar-image img-circle\" :src=\"atendimento.avatar_profissional.mini\" >\n    </div>\n    <div class=\"preview__info-col\">\n        <b>{{atendimento.nm_profissional}}</b><br>\n        Especialidade: {{atendimento.nm_especialidade}}\n    </div>\n    <div class=\"preview__label is-profissional\">Profissional</div>\n</div>\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    computed: {

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        }

    },

    methods: {}

});

Vue.component('PreviewProfissionalAtendimento', PreviewProfissionalAtendimento);
