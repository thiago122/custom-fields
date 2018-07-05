var vuexResponsavel = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_responsavel      :'',
            nm_responsavel      :'',
		  	id_usuario			: '',
		  	nm_usuario			: '',
		  	senha 				: '',
		  	email				: '',
		  	telefone			: '',
		  	celular				: '',
		  	login				: '',
		  	dt_nascimento		: '',
		  	whatsapp			: '',
		  	cpf					: '',
		  	uf					: '',
		  	municipio			: '',
		  	bairro 				: '',
		  	logradouro			: '',
		  	numero 				: '',
		  	complemento 		: ''
		},

	},

	mutations: {

	    SET_RESPONSAVEIS: function(state, payload){
	    	state.list.itens      = payload.responsavel.itens;
      		state.list.total      = payload.responsavel.total;
      		state.list.per_page   = payload.responsavel.per_page;
	    },

		SET_RESPONSAVEL: function(state, payload){
            state.selected.id_responsavel   = payload.id_responsavel;
            state.selected.nm_responsavel   = payload.nm_responsavel;
		  	state.selected.id_usuario		= payload.id_usuario;
		  	state.selected.nm_usuario		= payload.nm_usuario;
		  	state.selected.email			= payload.email;
		  	state.selected.telefone			= payload.telefone;
		  	state.selected.celular			= payload.celular;
		  	state.selected.login			= payload.login;
		  	state.selected.dt_nascimento	= dateToBrDate(payload.dt_nascimento);
		  	state.selected.whatsapp			= payload.whatsapp;
		  	state.selected.cpf				= payload.cpf;
		  	state.selected.uf				= payload.uf;
		  	state.selected.municipio		= payload.municipio;
		  	state.selected.bairro 			= payload.bairro;
		  	state.selected.logradouro		= payload.logradouro;
		  	state.selected.numero 			= payload.numero;
		  	state.selected.complemento 		= payload.complemento;
	    },

		RESET_RESPONSAVEL: function(state){
            state.selected.id_responsavel   ='';
            state.selected.nm_responsavel   ='';
		  	state.selected.id_usuario		='';
		  	state.selected.nm_usuario		='';
		  	state.selected.cod_ativacao		='';
		  	state.selected.fk_tipo_usuario	='';
		  	state.selected.fk_status_usuario='';
		  	state.selected.email			='';
		  	state.selected.telefone			='';
		  	state.selected.celular			='';
		  	state.selected.login			='';
		  	state.selected.senha			='';
		  	state.selected.dt_nascimento	='';
		  	state.selected.whatsapp			='';
		  	state.selected.cpf				='';
		  	state.selected.uf				='';
		  	state.selected.municipio		='';
		  	state.selected.bairro 			='';
		  	state.selected.logradouro		='';
		  	state.selected.numero 			='';
		  	state.selected.complemento 		='';	    
		},

		RESET_SENHA: function(state){
		  	state.selected.senha ='';    
		},

	    SET_URL_PARAMS_responsavel: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	},

	actions: {

		FETCH_RESPONSAVEIS: function({ commit, state }, payload){
         
           	serviceResponsavel.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_RESPONSAVEIS', result);
            });

		},

		LOAD_RESPONSAVEL: function ({ commit }, payload) {
            var request = serviceResponsavel.show(payload);
            request.done(function(result){
                commit('SET_RESPONSAVEL', result.item);
            });
		},

		ADD_RESPONSAVEL: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceResponsavel.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_RESPONSAVEIS');
	 				commit('SET_RESPONSAVEL', result.responsavel);
	 				commit('RESET_SENHA');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_RESPONSAVEL: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceResponsavel.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_RESPONSAVEIS');
	 				commit('RESET_SENHA');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_RESPONSAVEL: function ({ commit, dispatch }, payload) {
            var request = serviceResponsavel.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_RESPONSAVEIS');
                commit('RESET_RESPONSAVEL');
            });
		},

		RESET_RESPONSAVEL: function ({ commit }) {
            commit('RESET_RESPONSAVEL');
		},

		RESET_SENHA: function ({ commit }) {
            commit('RESET_SENHA');
		},

		SET_URL_PARAMS_RESPONSAVEL: function ({ commit },payload) {
            commit('SET_URL_PARAMS_responsavel', payload);
		},

	},

	getters: {

	}
}