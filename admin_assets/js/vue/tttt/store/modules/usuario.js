var vuexUsuario = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {
	            id_usuario:'',
	            nm_usuario:'',
			}
		},
		selected: {
            id_usuario : '',
            nm_usuario : '',
            id_tipo_usuario : '',
            email		 : '',
            login		 : '',
            senha		 : '',
            ativo		 : ''
		},

		usuario: {
			id: '',
			nome: '',
			token: ''
		},
		perms : [],
		tipos: []
	},

	mutations: {
 		SET_PERMISSOES_USUARIO: function(state, payload){
	    	state.perms = payload.permissoes;
	    	state.usuario.id = payload.usuario.id;
	    	state.usuario.nome = payload.usuario.nome;
	    },

 		LOGOUT: function(state){
 			console.log('>>(MUTATION) LOGOUT')
	    	state.usuario.id = '';
	    	state.usuario.nome = '';
	    	state.perms = [];
	    },


	    SET_USUARIOS: function(state, payload){
	    	state.list.itens      = payload.usuario.itens;
      		state.list.total      = payload.usuario.total;
      		state.list.per_page   = payload.usuario.per_page;
	    },

		SET_USUARIO: function(state, payload){
            state.selected.id_usuario = payload.usuario.id_usuario	;
            state.selected.nm_usuario = payload.usuario.nm_usuario;
            state.selected.id_tipo_usuario = payload.usuario.id_tipo_usuario;
            state.selected.email = payload.usuario.email;
            state.selected.login = payload.usuario.login;
            // state.selected.senha = payload.usuario.senha;
            state.selected.ativo = payload.usuario.situacao_usuario;
	    },

		SET_TIPO_USUARIO: function(state, payload){
            state.tipos = payload.tipo	;
	    },

		RESET_USUARIO: function(state){
            state.selected.id_usuario = '';
            state.selected.nm_usuario = '';
            state.selected.id_tipo_usuario = '';
            state.selected.email = '';
            state.selected.login = '';
            state.selected.senha = '';
            state.selected.ativo = '';
		},

	    SET_URL_PARAMS_USUARIO: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	},

	actions: {

		FETCH_USUARIOS: function({ commit, state }, payload){
         
           	serviceUsuario.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_USUARIOS', result);
            });

		},

		LOAD_USUARIO: function ({ commit }, payload) {
            var request = serviceUsuario.show(payload);
            request.done(function(result){
                commit('SET_USUARIO', result);
            });
		},


		EDIT_USUARIO: function ({ commit }, payload) {
            var request = serviceUsuario.edit(payload);
            request.done(function(result){
                commit('SET_USUARIO', result);
                commit('SET_TIPO_USUARIO', result);
            });
		},

		ADD_USUARIO: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceUsuario.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_usuario = result.id
	 				dispatch('FETCH_USUARIOS');
	 				// commit('SET_USUARIO', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_USUARIO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceUsuario.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_USUARIOS');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_USUARIO: function ({ commit, dispatch }, payload) {
            var request = serviceUsuario.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_USUARIOS');
                commit('RESET_USUARIO');
            });
		},
 
		SET_URL_PARAMS_USUARIO: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_USUARIO', payload);
		},

		'RESET_USUARIO' : function({ commit }){
			console.log('>>(COMMITANDO) RESET USUÁRIO')
			commit('RESET_USUARIO');
			// commit('LOGOUT');
		},

		'FETCH_PERMISSOES_USUARIO': function({ commit, state }){
			var self = this;
			var request = $.get( base_url + '/api/v1/private/perfil/');
			request.done(function(result){
				successLoading()
				commit('SET_PERMISSOES_USUARIO', result);
			}).fail(failLoading)
		},

		'LOGIN_REDIRECT': function({ commit }, payload){
			console.log('Login redirect')
			var self = this;
            var request = serviceLogin.login(payload);

			return new Promise( function(resolve, reject){
	            request.done(function(result){
	            	setTimeout(function(){
						router.push('classe')
	            	}, 200);
	            	
	            	successLoading();
	            	bus.$emit('modal_login_close');
	            	window.location.hash = 'classe';
	            	window.localStorage.setItem( 'login' , JSON.stringify( result ));
					commit('SET_PERMISSOES_USUARIO', result);
	            });
	        });

		},

		'LOGIN': function({ commit }, payload){

			var self = this;
            var request = serviceLogin.login(payload);

			return new Promise( function(resolve, reject){
	            request.done(function(result){
	            	successLoading();
	            	bus.$emit('modal_login_close');
	            	window.localStorage.setItem( 'login' , JSON.stringify( result ));
					commit('SET_PERMISSOES_USUARIO', result);
	            });
	        });

		},

		'LOGOUT' : function({ commit }){
			console.log('LOGOUT')
			var request = serviceLogin.logout();
			window.localStorage.clear();

		    setTimeout(function(){
				router.push('login')
        	}, 200);

			commit('LOGOUT');
		},

		'CHECK_LOGADO' : function({ state, commit }){

			var login = JSON.parse(window.localStorage.getItem( 'login' ));

			if(login){
				commit('SET_PERMISSOES_USUARIO', login);
			}

			// return state.usuario
			if(!state.usuario.id){
				commit('LOGOUT');
				return false;
			}

			return true;
		},

		'PERMISSOES' : function({ state }){
			return state.usuario.perms;
		},

	},

	getters: {

	}
}