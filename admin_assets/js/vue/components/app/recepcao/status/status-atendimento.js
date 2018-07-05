
var StatusAtendimento = Vue.extend({

    template: "<div class=\"popover-status-container\">\n\n    <div class=\"popover left popover-status\">\n        <div class=\"arrow\"></div>\n        <h3 class=\"popover-title\">Editar Status</h3>\n        <div class=\"popover-content\">\n            <div class=\"btn btn-sm btn-default btn-block\"\n                v-for=\"(status, index) in statusEdicaoAtendimento\"\n                v-bind:class=\"status.class_css\" @click=\"alterarStatus(status)\" :style=\"\">\n                {{ status.nm_status_atendimento }}\n            </div>\n        </div>\n    </div>\n\n    <button\n        type=\"button\"\n\n        class=\"btn btn-sm btn-na btn-default btn-block\"\n        v-bind:class=\"atendimento.class_css\" >\n        <b>Status:</b> {{atendimento.nm_status_atendimento}}\n    </button>\n</div>\n",

    store: storeRecepcao,

    data: function () {
        return {
            exibindoStatusAtendimento: false
        }
    },

    mounted: function(){
        var self = this;

        $('body').on('click', '.popover-status-container > button', function(event){
            event.stopPropagation();
            self.toggleStatusAtendimento();
        });

        $(document).on('click', function(event){
            $('.popover').hide();
            self.exibindoStatusAtendimento = false;
        });

    },

    computed: {

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        },

        dadosBasicos: function(){
            return this.$store.state.recepcao.dadosBasicos;
        },

        statusEdicaoAtendimento: function(){
            return this.$store.getters.statusEdicaoAtendimento
        }


    },

    methods: {

        alterarStatus: function(status){
            logProcesso('ALTERAR STATUS')
            this.$store.dispatch( 'SAVE_STATUS_ATENDIMENTO', status );
        },

        toggleStatusAtendimento: function(){

            if(this.exibindoStatusAtendimento == true){
                $('.popover').hide();
                this.exibindoStatusAtendimento = false;
            }else{
                this.exibindoStatusAtendimento = true;
                $('.popover').show();
            }

        },

    }

});

Vue.component('StatusAtendimento', StatusAtendimento);
