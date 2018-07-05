
var PreviewHorarioAtendimento = Vue.extend({

    template: "\n<div class=\"clearfix preview\">\n    <div class=\"preview__info-col\">\n        Data: {{atendimento.data}} <br>\n        Hora: de {{atendimento.inicio}} até {{atendimento.fim}}\n    </div>\n    <div class=\"preview_info-col\">\n        <status-atendimento v-if=\"atendimento.id_usuario_agendante\" style=\"width:200px; float: right\"></status-atendimento>\n    </div>\n</div>\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    computed: {

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        },

        dadosBasicos: function(){
            return this.$store.state.recepcao.dadosBasicos;
        },
    },

    methods: { }

});

Vue.component('PreviewHorarioAtendimento', PreviewHorarioAtendimento);
