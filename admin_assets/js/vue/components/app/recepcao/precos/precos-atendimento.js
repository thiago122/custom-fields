
var PrecosAtendimento = Vue.extend({
    template: "\n<span class=\"dropdown\">\n\n    <a class=\"btn btn-default\" id=\"precos-atendimento\" data-target=\"#\" href=\"http://example.com\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">\n        {{label}}\n        <span class=\"caret\"></span>\n    </a>\n\n    <ul\n    class=\"dropdown-menu\"\n    aria-labelledby=\"precos-atendimento\"\n    style=\"background-color: #f4f4f4; border: 1px solid #dddddd;\">\n        <li v-for=\"especialidade in especialidades\" style=\"padding: 5px; border-bottom: 1px solid #c9c9c9; width: 300px;\">\n            <span style=\"width:80px; display: inline-block;\"><b>R$ {{especialidade.valor}}</b> </span> {{especialidade.nm_especialidade}}\n        </li>\n    </ul>\n</span>\n",
    store: storeRecepcao,
    data: function () {
        return {}
    },

    props: {

        tipo: {
            default: 1
        },

        label: {
            type: String,
            default: 'Preço '
        },

    },

    computed: {
        especialidades: function(){

            var self = this;
            var especialidades = [];
            var especialidadesClinica = this.$store.state.recepcao.clinica.especialidadesClinica;

            especialidadesClinica.forEach(function(item){
                if(item.tipo_especialidade_id == self.tipo){
                    especialidades.push(item)
                }
            });

            return especialidades;
        }
    },
    methods: {}
});

Vue.component('PrecosAtendimento', PrecosAtendimento);
