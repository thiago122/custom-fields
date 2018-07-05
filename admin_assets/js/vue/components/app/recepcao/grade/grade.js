
var gradeRecepcao = Vue.extend({

    template: "<table class=\"table table-hover table-bordered table-grade\">\n\n    <thead>\n        <tr>\n            <th class=\"no-border\" width=\"50\"></th>\n            <th v-for=\"profissional in clinica.profissionaisClinica\">\n                {{profissional.nm_profissional}}\n            </th>\n        </tr>\n    </thead>\n\n    <tbody>\n        <tr v-for=\"linha in grade\">\n            <td class=\"no-border intervalo\">{{linha.inicioIntervalo}}</td>\n            <td v-for=\"profissional in linha.profissionais\">\n\n                <div  v-for=\"item in profissional.itens\">\n                    <item-atendimento\n                    v-if=\"item.atendimento\"\n                    :atendimento=\"item.atendimento\"\n\n                    v-bind:exibir-especialidade=\"true\"\n                    v-bind:exibir-profissional=\"true\"\n                    v-bind:exibir-botoes=\"false\"\n                    v-bind:exibir-hora-inicial=\"true\"\n                    v-bind:exibir-hora-final=\"true\"\n                    >\n\n                    </item-atendimento>\n                    <div class=\"vasio\" v-else  @click=\"exibirDetalheAtendimentoVazio(item, profissional) \">\n                        <small> {{item.inicio | time(\'HH:mm\') }} - {{item.fim | time(\'HH:mm\') }}</small>\n                    </div>\n                </div>\n\n            </td>\n        </tr>\n    </tbody>\n\n</table>\n",

    store: storeRecepcao,

    data: function () {
        return {}
    },

    computed: {

        dadosBasicos: function(){
            return this.$store.state.recepcao.dadosBasicos;
        },

        clinica: function(){
            return this.$store.state.recepcao.clinica;
        },

        grade: function(){
            return this.$store.state.recepcao.grade;
        },
    },

    methods: {

        exibirDetalheAtendimento: function(item, profissional){

            logProcesso(' (GRADE) EXIBIR_DETALHE_ATENDIMENTO');
            this.$store.dispatch('ATENDIMENTO', item.atendimento);
            this.$emit('atendimento-selecionado', item);
            this.$store.dispatch('SET_TIPO_EDICAO', 'profissional');
        },

        exibirDetalheAtendimentoVazio: function(item, profissional){

            logProcesso(' (GRADE) EXIBIR_DETALHE_ATENDIMENTO VAZIO');

            var atendimento = {
                inicio_agendamento: moment( new Date() ).format('YYYY-MM-DD') + ' ' + item.inicio,
                fim_agendamento: moment( new Date() ).format('YYYY-MM-DD') + ' ' + item.fim,
                id_profissional: profissional.id_profissional,
            }

            this.$store.dispatch('ATENDIMENTO_VASIO', atendimento);
            this.$emit('atendimento-selecionado', item);
            this.$store.dispatch('SET_TIPO_EDICAO', 'profissional');
            this.$store.dispatch('SET_STATUS_ATENDIMENTO_AGENDADO');

        },


    }

});

Vue.component('gradeRecepcao', gradeRecepcao);
