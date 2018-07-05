var vuexDisciplina = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {
	            id_disciplina      			:'',
	            nm_disciplina      			:'',
	            abreviacao_nm_disciplina   	:'',
			  	situacao_disciplina			: 0,
			}
		},
		selected: {
            id_disciplina: '',
            nm_disciplina: '',
		  	abreviacao_nm_disciplina: '',
		  	situacao_disciplina: '',
		},
	},

	mutations: {

	    SET_DISCIPLINAS: function(state, payload){
	    	state.list.itens      = payload.disciplina.itens;
      		state.list.total      = payload.disciplina.total;
      		state.list.per_page   = payload.disciplina.per_page;
	    },

		SET_DISCIPLINA: function(state, payload){
            state.selected.id_disciplina   				= payload.item.id_disciplina;
            state.selected.nm_disciplina   				= payload.item.nm_disciplina;
		  	state.selected.abreviacao_nm_disciplina		= payload.item.abreviacao_nm_disciplina;
		  	state.selected.situacao_disciplina			= payload.item.situacao_disciplina;
	    },

		RESET_DISCIPLINA: function(state){
            state.selected.id_disciplina   				= '';
            state.selected.nm_disciplina   				= '';
		  	state.selected.abreviacao_nm_disciplina		= '';
		  	state.selected.situacao_disciplina			= '';
		},

	    SET_URL_PARAMS_DISCIPLINA: function(state, payload){
	    	state.list.urlParams  = payload;
	    },


	},

	actions: {

		FETCH_DISCIPLINAS: function({ commit, state }, payload){
         
           	serviceDisciplina.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_DISCIPLINAS', result);
            });

		},

		LOAD_DISCIPLINA: function ({ commit }, payload) {
            var request = serviceDisciplina.show(payload);
            request.done(function(result){
                commit('SET_DISCIPLINA', result);
            });
		},

		ADD_DISCIPLINA: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceDisciplina.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_disciplina = result.id
	 				dispatch('FETCH_DISCIPLINAS');
	 				// commit('SET_DISCIPLINA', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_DISCIPLINA: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceDisciplina.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_DISCIPLINAS');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_DISCIPLINA: function ({ commit, dispatch }, payload) {
            var request = serviceDisciplina.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_DISCIPLINAS');
                commit('RESET_DISCIPLINA');
            });
		},

		RESET_DISCIPLINA: function ({ commit }) {
            commit('RESET_DISCIPLINA');
		},

		RESET_SENHA: function ({ commit }) {
            commit('RESET_SENHA');
		},

		SET_URL_PARAMS_DISCIPLINA: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_DISCIPLINA', payload);
		},
        CHECK_DISCIPLINA: function({ commit },payload){
            commit('CHECK_DISCIPLINA', payload);
        }
	},

	getters: {

	}
}