
var routes = [
	{
		path: '/',
		component: Classe,
		meta: { requiresAuth: true},
	},
	{
		path: '/login',
		component: Login,
	},
	{
		path: '/classe',
		component: Classe,
		meta: { requiresAuth: true},
		name: 'Classe'
	},
	{
		path: '/aluno',
		component: Aluno,
		meta: { requiresAuth: true},
		name: 'Aluno'
	},
	{
		path: '/responsavel',
		component: Responsavel,
		meta: { requiresAuth: true},
		name: 'Responsavel'
	},
	{
		path: '/recuperacao',
		component: Recuperacao,
		meta: { requiresAuth: true},
		name: 'Recuperacao'
	},
	{
		path: '/avaliacao',
		component: Avaliacao,
		meta: { requiresAuth: true},
		name: 'Avaliacao'
	},
];

var router = new VueRouter({
  routes: routes
});

router.beforeEach(function(to, from, next){

	var checker = storeClasse.dispatch('CHECK_LOGADO');
	to.matched.some(function(record){
		
		if(record.meta.requiresAuth){

			checker.then(function(isLogado){

				if(isLogado === false){
					next({
				        path: '/login',
				        query: {
				          redirect: to.fullPath,
				        },
			      	});				
				}else{
					
					next();
				}				
			}); 
			

		}else{
			next();
		}
	});
	
});

var app = new Vue({	
	router: router,
	el: '#app',
	mixins: [aclMixin],

	data: {
		usuario: storeClasse.state.usuario.usuario
	},

	computed:{
		classHasSidebar: function(){
			return (this.usuario.id) ? '': 'toggled' ;
		}
	}
	
})