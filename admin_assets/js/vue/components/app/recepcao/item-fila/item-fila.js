
var itemFila = Vue.extend({

    template: "\n    <div class=\"item-fila\" >\n\n        <div @click=\"clicado(item)\">\n            <i\n                class=\"fa fa-fw icon-iten-fila\"\n                v-bind:style=\"{color:item.exadecimal_cor}\"\n                v-bind:class=\"item.class_icone\"\n            >\n            </i>\n\n            <span style=\"font-size: 12px; font-weight: 700; color: #1ba7d9;\">\n                {{item.inicio_agendamento | date(\'HH:mm\') }}\n            </span> <br>\n            {{nome_agendante}}\n        </div>\n\n        <div class=\"item-fila__info\">\n\n            Status: {{item.nm_status_atendimento}} <br>\n            Profissional: {{item.nm_profissional}} <br>\n            Procedimento: {{item.nm_tipo_especialidade}} <br><br>\n\n            <button\n                class=\"btn btn-sm btn-block btn-success\"\n                v-if=\"item.id_status_atendimento < 5\"\n                @click=\"iniciarAtendimento(item)\"\n            >\n                Iniciar atendimento\n            </button>\n            <button\n                class=\"btn btn-sm btn-block btn-danger\"\n                v-if=\"item.id_status_atendimento == 5\"\n                @click=\"encerrarAtendimento(item)\"\n            >\n                Encerrar atendimento\n            </button>\n\n\n\n        </div>\n\n    </div>\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    props: {
        atendimento: {
            required: true
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

Vue.component('itemFila', itemFila);
