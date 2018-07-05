var vuexContato = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {
	            id_contato:'',
	            titulo:'',
			}
		},
		selected: {
            id_contato	: '',
            titulo		: '',
            mensagem	: '',
            id_aluno	: '',
		},
		aluno: {
			nm_aluno: '',
			id_aluno: ''
		},
		respostas: [],
		resposta: '',

	},

	mutations: {

	    SET_CONTATOS: function(state, payload){
	    	state.list.itens      = payload.contato.itens;
      		state.list.total      = payload.contato.total;
      		state.list.per_page   = payload.contato.per_page;
	    },

		SET_CONTATO: function(state, payload){
            state.selected.id_contato 	  = payload.contato.id_contato;
            state.selected.titulo    	  = payload.contato.titulo;
            state.selected.mensagem 	  = payload.contato.mensagem;
            state.selected.created_at 	  = payload.contato.created_at;

            state.aluno.id_aluno = payload.contato.id_aluno;
            state.aluno.nm_aluno = payload.contato.nm_aluno;
	    },

		RESET_CONTATO: function(state){
            state.selected.id_contato 	= '';
            state.selected.titulo    	= '';
            state.selected.mensagem 	= '';
			state.selected.created_at	= '';
		},

		RESET_RESPOSTA: function(state){
            state.resposta 	= '';
		},

		SET_ALUNO_CONTATO: function(state, payload){
            state.selected.id_aluno = payload.item.id_aluno;
            state.aluno.id_aluno = payload.item.id_aluno;
            state.aluno.nm_aluno = payload.item.nm_aluno;
	    },

		RESET_ALUNO_CONTATO: function(state, payload){
            state.selected.id_aluno = '';
            state.aluno.nm_aluno = '';
            state.aluno.id_aluno = '';
	    },

		RESET_RESPOSTAS_CONTATO: function(state, payload){
            state.respostas = [];
	    },

		SET_RESPOSTAS_CONTATO: function(state, payload){
            state.respostas = payload.contato.respostas;
	    },

	    SET_URL_PARAMS_CONTATOS: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	    SET_LIDO: function(state, payload){
	    	state.list.itens[payload.index].nao_lido_admin = 0;
	    }
	},

	actions: {

		FETCH_CONTATOS: function({ commit, state }, payload){
         
           	serviceContato.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_CONTATOS', result);
            });
		},

		LOAD_CONTATO: function ({ commit, dispatch }, payload) {
            var request = serviceContato.show(payload);
            request.done(function(result){
                commit('SET_CONTATO', result);
                commit('SET_RESPOSTAS_CONTATO', result);
                dispatch('REGISTRAR_LEITURA', payload);
            });
		},

		RESPONDER_CONTATO: function ({ commit, dispatch }, payload) {
            var request = serviceContato.responder(payload);
            request.done(function(result){
                dispatch('LOAD_CONTATO', payload);
                commit('RESET_RESPOSTA');
            });
		},

		LOAD_ALUNO_CONTATO: function ({ commit }, payload) {
            var request = serviceAlunos.show(payload);
            request.done(function(result){

				commit('RESET_ALUNO_CONTATO',result);
				commit('SET_ALUNO_CONTATO',result);

            });
		},

		REGISTRAR_LEITURA: function({ commit },payload){
			
            var request = serviceContato.registrarLeitura(payload);
            request.done(function(result){
            	commit('SET_LIDO', payload);
				console.log('LEITURA REGISTRADA');

            });
		},

		ADD_CONTATO: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceContato.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_contato = result.id_contato
	 				dispatch('FETCH_CONTATOS');
	 				// commit('SET_CONTATO', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_CONTATO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceContato.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_CONTATOS');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_CONTATO: function ({ commit, dispatch }, payload) {
            var request = serviceContato.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_CONTATOS');
                commit('RESET_CONTATO');
            });
		},

		RESET_CONTATO: function ({ commit }) {
            commit('RESET_CONTATO');
		},

		RESET_ALUNO_CONTATO: function ({ commit }) {
            commit('RESET_ALUNO_CONTATO');
		},

		SET_URL_PARAMS_CONTATOS: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_CONTATOS', payload);
		}
	},

}