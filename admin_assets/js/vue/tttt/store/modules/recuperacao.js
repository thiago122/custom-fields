var vuexRecuperacao = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_recuperacao       :'',
            nm_recuperacao       :'',
            fk_classe 			 :'',
            id_classe 			 :'',
            id_disciplina 		 :'',
            fk_disciplina 		 :'',
		},
		periodosAvaliacao: [],
	},

	mutations: {

	    SET_RECUPERACOES: function(state, payload){
	    	state.list.itens      = payload.recuperacao.itens;
      		state.list.total      = payload.recuperacao.total;
      		state.list.per_page   = payload.recuperacao.per_page;
	    },

		SET_RECUPERACAO: function(state, payload){
			state.selected = payload
            state.selected.id_recuperacao       = payload.id_recuperacao ;
            state.selected.nm_recuperacao       = payload.nm_recuperacao ;
            state.selected.data_recuperacao     = brDateToDate( payload.data_recuperacao ) ;
	    },

		RESET_RECUPERACAO: function(state){
            state.selected.id_recuperacao   = '';
            state.selected.fk_classe       	= '';
            state.selected.id_classe       	= '';
            state.selected.id_disciplina    = '';
            state.selected.fk_disciplina    = '';
            state.selected.data_recuperacao = '';
	    },

	    SET_URL_PARAMS_RECUPERACAO: function(state, payload){
	    	state.list.urlParams  = payload;
	    },

		SET_PERIODOS_AVALIACAO: function(state, payload){

			state.periodosAvaliacao = payload;
		},

	   	RESET_DISCIPLINA_SELECIONADA: function(state){
	    	state.selected.id_disciplina = '';
	    	state.selected.fk_disciplina = '';
	    },
	},

	actions: {

		FETCH_RECUPERACOES: function({ commit, state }, payload){
         
           	serviceRecuperacao.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_RECUPERACOES', result);
            });

		},

		FETCH_PERIODOS_AVALIACAO: function({commit}, payload){
            var request = serviceRecuperacao.periodosAvaliacao(payload);
            request.done(function(result){
                commit('SET_PERIODOS_AVALIACAO', result.itens);
            });

		},
		

		LOAD_RECUPERACAO: function ({ commit }, payload) {
            var request = serviceRecuperacao.show(payload);
            request.done(function(result){
                commit('SET_RECUPERACAO', result.item);
            });
		},

		ADD_RECUPERACAO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceRecuperacao.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_RECUPERACOES');
	 				commit('SET_RECUPERACAO', result.recuperacao);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_RECUPERACAO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceRecuperacao.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_RECUPERACOES');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_RECUPERACAO: function ({ commit, dispatch }, payload) {
            var request = serviceRecuperacao.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_RECUPERACOES');
                commit('RESET_RECUPERACAO');
            });
		},

		RESET_RECUPERACAO: function ({ commit }) {
            commit('RESET_RECUPERACAO');
		},

		SET_URL_PARAMS_RECUPERACAO: function ({ commit },payload) {
            commit('SET_URL_PARAMS_RECUPERACAO', payload);
		},

		RESET_DISCIPLINA_SELECIONADA: function({commit}){
			 commit('RESET_DISCIPLINA_SELECIONADA');
		}
	},

	getters: {

	}
}