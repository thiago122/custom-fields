var vuexProfessor = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {
	            id_professor:'',
	            nm_professor:'',
			}
		},
		selected: {
            id_professor : '',
            nm_professor : '',
            email		 : '',
            login		 : '',
            senha		 : '',
            ativo		 : ''
		},
	},

	mutations: {

	    SET_PROFESSORES: function(state, payload){
	    	state.list.itens      = payload.professor.itens;
      		state.list.total      = payload.professor.total;
      		state.list.per_page   = payload.professor.per_page;
	    },

		SET_PROFESSOR: function(state, payload){
            state.selected.id_professor = payload.professor.id_professor	;
            state.selected.nm_professor = payload.professor.nm_professor;
            state.selected.email = payload.professor.email;
            state.selected.login = payload.professor.login;
            // state.selected.senha = payload.professor.senha;
            state.selected.ativo = payload.professor.situacao_professor;
	    },

		RESET_PROFESSOR: function(state){
            state.selected.id_professor 	= '';
            state.selected.nm_professor    	= '';
            state.selected.email = '';
            state.selected.login = '';
            state.selected.senha = '';
            state.selected.ativo = '';
		},

	    SET_URL_PARAMS_PROFESSOR: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	},

	actions: {

		FETCH_PROFESSORES: function({ commit, state }, payload){
         
           	serviceProfessor.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_PROFESSORES', result);
            });

		},

		LOAD_PROFESSOR: function ({ commit }, payload) {
            var request = serviceProfessor.show(payload);
            request.done(function(result){
                commit('SET_PROFESSOR', result);
            });
		},

		ADD_PROFESSOR: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceProfessor.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_professor = result.id
	 				dispatch('FETCH_PROFESSORES');
	 				// commit('SET_PROFESSOR', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_PROFESSOR: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceProfessor.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_PROFESSORES');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_PROFESSOR: function ({ commit, dispatch }, payload) {
            var request = serviceProfessor.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_PROFESSORES');
                commit('RESET_PROFESSOR');
            });
		},

		RESET_PROFESSOR: function ({ commit }) {
            commit('RESET_PROFESSOR');
		},

		SET_URL_PARAMS_PROFESSOR: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_PROFESSOR', payload);
		}
	},

	getters: {

	}
}