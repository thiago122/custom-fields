
var EditProfissionalAtendimento = Vue.extend({

    template: "\n\n<div>\n\n    <div class=\"row\" v-if=\"atendimento.tipo_edicao == \'especialidade\'\">\n        <div class=\"col-md-6\">\n             <div class=\"form-group\">\n                <label>Especialidade</label>\n                <select class=\"form-control input-sm\" v-model=\"atendimento.id_especialidade\">\n                    <option ></option>\n                    <option v-for=\"(especialidade, index) in especialidades\" :value=\"especialidade.id_especialidade\">\n                        {{ especialidade.nm_especialidade }}\n                    </option>\n                </select>\n             </div>\n        </div>\n        <div class=\"col-md-6\" v-if=\"profissionaisEspecialidade.length > 0\">\n            <div class=\"form-group\">\n                <label>Profissional</label>\n                <select class=\"form-control input-sm\" v-model=\"atendimento.id_profissional\">\n                    <option ></option>\n                    <option v-for=\"(profissional, index) in profissionaisEspecialidade\" :value=\"profissional.id_profissional\">\n                        {{ profissional.nm_profissional }}\n                    </option>\n                </select>\n            </div>\n        </div>\n    </div>\n\n    <div class=\"row\" v-if=\"atendimento.tipo_edicao == \'profissional\'\">\n        <div class=\"col-md-6\">\n            <div class=\"form-group\">\n                <div class=\"form-group\">\n                    <label>Especialidade</label>\n                    <select class=\"form-control input-sm\" v-model=\"atendimento.id_especialidade\">\n                        <option ></option>\n                        <option v-for=\"(especialidade, index) in especialidadesProfissional\" :value=\"especialidade.id_especialidade\">\n                            {{ especialidade.nm_especialidade }}\n                        </option>\n                    </select>\n                </div>\n            </div>\n        </div>\n        <div class=\"col-md-6\">\n\n            <div class=\"form-group\">\n                <label>Profissional</label>\n                <input class=\"form-control input-sm\" type=\"text\" v-model=\"profissional.nm_profissional\" disabled>\n            </div>\n\n        </div>\n    </div>\n\n</div><!-- root -->\n\n",

    store: storeRecepcao,

    data: function () {
        return {
            exibirProfissionaisEspecialidade : false
        }
    },

    computed: {

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        },

        especialidades: function(){
            return this.$store.state.recepcao.clinica.especialidadesClinica;
        },

        profissionais: function(){
            return this.$store.state.recepcao.clinica.profissionaisClinica;
        },

        profissionaisEspecialidade: function(){

            var self = this;

            var profissionais = [];

            if(this.atendimento.id_especialidade){
                var especialidade = _.find(self.especialidades, function(o) {
                    return o.id_especialidade == self.atendimento.id_especialidade;
                });

                if(especialidade){
                    profissionais = especialidade.profissionais
                }

            }

            return profissionais;
        },

        profissional: function(){

            var self = this;
            var profissional = {id_profissional: '', nm_profissional: ''};

            if(this.atendimento.id_profissional){
                profissional = _.find(self.profissionais, function(o) {
                    return o.id_profissional == self.atendimento.id_profissional;
                });
            }

            return profissional;
        },

        especialidadesProfissional: function(){

            var self = this;

            var especialidades = [];

            if(this.atendimento.id_profissional){

                var profissional = _.find(self.profissionais, function(o) {
                    return o.id_profissional == self.atendimento.id_profissional;
                });

                especialidades = profissional.especialidades

            }

            return especialidades;
        },


    },

    methods: {}

});

Vue.component('EditProfissionalAtendimento', EditProfissionalAtendimento);
