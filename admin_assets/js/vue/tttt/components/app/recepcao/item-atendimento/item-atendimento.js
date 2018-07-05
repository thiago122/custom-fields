
var itemAtendimento = Vue.extend({

    template: "<div class=\"atendimento\"\n    v-bind:class=\"item.class_css\"\n    style=\"position: relative;\"\n>\n\n    <div class=\"clearfix\" style=\"cursor: pointer;\" @click=\"clicado(item)\" >\n\n        <div class=\"pull-left\">\n            <b>{{nome_agendante}} &nbsp;</b>\n        </div>\n        <div class=\"pull-right time\">\n            <small v-if=\"exibirHoraInicial\"> {{item.inicio_agendamento | date(\'HH:mm\') }} </small>\n            <small v-if=\"exibirHoraFinal\"> - {{item.fim_agendamento | date(\'HH:mm\') }}</small>\n        </div>\n\n        <hr style=\"margin: 0; border-top-color: #cfd1d4; clear: both; \">\n        <div class=\"clearfix\">\n\n            <b class=\"pull-right\" v-if=\"exibirProfissional\">{{item.nm_profissional}}</b>\n            <b class=\"pull-left\" v-if=\"exibirEspecialidade\">{{item.nm_especialidade}}</b>\n        </div>\n    </div>\n\n    <div style=\"position: absolute; bottom: 0; right: 0\" v-if=\"exibirBotoes\">\n\n        <small\n            class=\"btn-fila-play\"\n            v-if=\"item.id_status_atendimento < 5\"\n            @click=\"iniciarAtendimento(item)\"\n        >\n            <i class=\"fa fa-fw fa-play\"></i> <!-- iniciar -->\n        </small>\n        <small\n            class=\"btn-fila-stop\"\n            v-if=\"item.id_status_atendimento == 5\"\n            @click=\"encerrarAtendimento(item)\"\n        >\n            <i class=\"fa fa-fw fa-stop\"></i> <!-- encerrar -->\n        </small>\n\n    </div>\n\n\n</div>\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    props: {

        atendimento: {
            required: true
        },

        exibirBotoes: {
            default: false
        },

        exibirEspecialidade: {
            default: false
        },

        exibirProfissional: {
            default: false
        },

        exibirHoraInicial: {
            default: false
        },

        exibirHoraFinal: {
            default: false
        },

    },

    mounted: function(){

    },

    computed: {

        item: function(){
            return this.atendimento;
        },

        nome_agendante: function(){
            return this.atendimento.nm_agendante || this.atendimento.nome
        }

    },

    methods: {

        clicado: function(atendimento){

            logProcesso(' (ITEM) EXIBIR_DETALHE_ATENDIMENTO');
            this.$store.dispatch('ATENDIMENTO', atendimento);
            this.$store.dispatch('SET_TIPO_EDICAO', 'profissional');
            this.$emit('atendimento-selecionado', atendimento);

        },
        iniciarAtendimento: function(atendimento){
            this.$store.dispatch('SAVE_STATUS_ATENDIMENTO_ATENDENDO', atendimento);
        },

        encerrarAtendimento: function(atendimento){
            this.$store.dispatch('SAVE_STATUS_ATENDIMENTO_ATENDIDO', atendimento);
        },
    }

});

Vue.component('itemAtendimento', itemAtendimento);
