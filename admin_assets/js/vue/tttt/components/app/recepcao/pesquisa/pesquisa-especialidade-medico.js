
var PesquisaEspecialidadeMedico = Vue.extend({

    template: "<div>\n\n    <div class=\"form-group\">\n\n        <label>Especialidade</label>\n        <select class=\"form-control input-sm\" v-model=\"indexEspecialidade\" @change=\"selecionarEspecialidade\">\n            <option ></option>\n            <option v-for=\"(especialidade, index) in clinica.especialidadesClinica\" :value=\"index\">{{ especialidade.nm_especialidade }} </option>\n        </select>\n\n    </div>\n\n    <div class=\"form-group\" v-if=\"stringIndexEspecialidade\" @change=\"alterado\">\n        <label>Profissional</label>\n        <select class=\"form-control input-sm\" v-model=\"idProfissional\">\n            <option ></option>\n            <option v-for=\"(profissional, index) in profissionais\" :value=\"profissional.id_profissional\">\n                {{ profissional.nm_profissional }}\n            </option>\n        </select>\n    </div>\n\n<!--     <div class=\"form-group\">\n        <button class=\"btn btn-default\" @click=\"alterado\" v-if=\"stringIndexEspecialidade\">\n        Selecionar\n        </button>\n    </div> -->\n</div>\n",

    store: storeRecepcao,

    data: function () {
        return {
            indexEspecialidade: '',
            idProfissional: ''
        }
    },

    computed: {

        dadosBasicos: function(){
            return this.$store.state.recepcao.dadosBasicos;
        },

        clinica: function(){
            return this.$store.state.recepcao.clinica;
        },

        profissionais: function(){

            if( ! String(this.indexEspecialidade) ){
                return [];
            }

            return this.clinica.especialidadesClinica[this.indexEspecialidade].profissionais;

        },

        stringIndexEspecialidade: function(){
            if( ! String(this.indexEspecialidade) ){
                return '';
            }
            return String(this.indexEspecialidade)
        },

        especialidadeSelecionada: function(){

            if( !this.stringIndexEspecialidade ){
                return {};
            }

            return this.clinica.especialidadesClinica[this.stringIndexEspecialidade];
        },

        profissionalSelecionado: function(){

            if( !this.idProfissional ){
                return {};
            }

            var self = this;

            var profissionais = this.clinica.especialidadesClinica[this.stringIndexEspecialidade].profissionais;

            profissionaisClinica = JSON.parse( JSON.stringify( profissionais ) );

            profissionalSelecionado = _.find(profissionaisClinica, function(o) {
                return o.id_profissional == self.idProfissional;
            });

            return profissionalSelecionado;
        },
    },

    methods: {

        selecionarEspecialidade: function(){

            logProcesso(' SELECIONAR ESPECIALIDADE ');

            this.idProfissional = '';
            this.alterado()
        },

        alterado: function(){

            var dados = {
                especialidade:   this.especialidadeSelecionada,
                profissional:    this.profissionalSelecionado,
            }

            this.$emit('alterado', dados);
        }
    }

});

Vue.component('PesquisaEspecialidadeMedico', PesquisaEspecialidadeMedico);
