

var EditProfissionalGrade = Vue.extend({

    template: "<div class=\"row\">\n    <div class=\"col-md-3\">\n        <label>Data</label>\n        <input type=\"text\" class=\"form-control input-sm\" placeholder=\"Data\" v-model=\"atendimento.data\" v-mask=\"\'##/##/####\'\">\n    </div>\n    <div class=\"col-md-2\">\n        <label>De </label>\n        <input type=\"text\" class=\"form-control input-sm\" placeholder=\"Início\" v-model=\"atendimento.inicio\" v-mask=\"\'##:##\'\">\n    </div>\n    <div class=\"col-md-2\">\n        <label>Até</label>\n        <input type=\"text\" class=\"form-control input-sm\" placeholder=\"Fim\" v-model=\"atendimento.fim\" v-mask=\"\'##:##\'\">\n    </div>\n</div>\n",

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
