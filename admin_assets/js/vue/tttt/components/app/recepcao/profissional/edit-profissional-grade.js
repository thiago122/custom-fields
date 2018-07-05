

var EditProfissionalGrade = Vue.extend({

    template: "<div class=\"row\">\n    <div class=\"col-md-6\">\n        <div class=\"form-group\">\n            <label>Especialidade </label>\n\n            <select class=\"form-control input-sm\" v-model=\"atendimento.id_especialidade\">\n                <option ></option>\n                <option v-for=\"(especialidade, index) in atendimento.especialidades\" :value=\"especialidade.id_especialidade\">{{ especialidade.nm_especialidade }} </option>\n            </select>\n        </div>\n\n    </div>\n\n    <div class=\"col-md-6\">\n        <div class=\"form-group\">\n            <label>Profissional</label>\n            <input class=\"form-control input-sm\" type=\"text\" v-model=\"atendimento.nm_profissional\" disabled>\n        </div>\n    </div>\n</div>\n\n\n",

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



    }

});

Vue.component('EditProfissionalGrade', EditProfissionalGrade);
