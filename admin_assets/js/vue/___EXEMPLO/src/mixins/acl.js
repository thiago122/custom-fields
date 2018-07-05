var aclMixin = {
    store: storeClasse,

    computed: {
        permissions: function(){
            return this.$store.state.usuario.perms;
        },


    },

	methods: {

		can: function(permission){
            return this.aclCheck(permission);
		},

        aclCheck(permission) {

            if (permission === 'undefined'){
                return false
            }

            var permissions = (permission.indexOf('|') !== -1) ? permission.split('|') : [permission]
                
            return this.aclFind(permissions);
        },

        aclFind( perms){

            var self = this;
            var found = [];

            perms.find(function(permission){
                if( self.permissions.indexOf(permission) !== -1 ){
                    found.push(permission);
                }
            });

            return found.length > 0;
        },

        isPeriodoBoletins: function(state){
            var classe = this.$store.state.classe.selected;
            return (classe.periodo_atual <= classe.qt_periodos)
        },

        canCalcularMedia: function(state){
            var classe = this.$store.state.classe.selected;
            return(classe.periodo_atual == (parseInt(classe.qt_periodos) + 1));
        },
        canEncerrarClasse: function(state){
            var classe = this.$store.state.classe.selected;
            return(classe.periodo_atual == (parseInt(classe.qt_periodos) + 2));
        },
        canAtualizarAprovados: function(state){
            var classe = this.$store.state.classe.selected;
            return(classe.periodo_atual == (parseInt(classe.qt_periodos) + 3));
        },

	},
}