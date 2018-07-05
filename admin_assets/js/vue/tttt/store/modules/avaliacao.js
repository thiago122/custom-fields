var vuexAvaliacao = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_avaliacao         :'',
            nm_avaliacao         :'',
            fk_classe 			 : '',
            id_classe 			 : '',
            id_disciplina 		 : '',
            fk_disciplina 		 : '',
            fk_tipo_avaliacao	 : '',
            data_avaliacao		 :'',
		},
	},


	mutations: {

	    SET_AVALIACOES: function(state, payload){
	    	state.list.itens      = payload.avaliacao.itens;
      		state.list.total      = payload.avaliacao.total;
      		state.list.per_page   = payload.avaliacao.per_page;
	    },

		SET_AVALIACAO: function(state, payload){
			console.log( payload)
			state.selected = payload


            state.selected.id_avaliacao     = payload.id_avaliacao;
            state.selected.fk_classe       	= payload.fk_classe;
            state.selected.id_classe       	= payload.id_classe;
            state.selected.id_disciplina    = payload.id_disciplina;
            state.selected.fk_disciplina    = payload.fk_disciplina;
            state.selected.data_avaliacao   = brDateToDate( payload.data_avaliacao );
            state.selected.fk_tipo_avaliacao= payload.fk_tipo_avaliacao;

	    },

		RESET_AVALIACAO: function(state){
            state.selected.id_avaliacao     = '';
            state.selected.fk_classe       	= '';
            state.selected.id_classe       	= '';
            state.selected.id_disciplina    = '';
            state.selected.fk_disciplina    = '';
            state.selected.data_avaliacao   = '';
            state.selected.fk_tipo_avaliacao= '';
	    },

	    SET_URL_PARAMS_AVALIACAO: function(state, payload){
	    	state.list.urlParams  = payload;
	    },

	   	RESET_DISCIPLINA_SELECIONADA: function(state){
	    	state.selected.id_disciplina = '';
	    	state.selected.fk_disciplina = '';
	    },
	},

	actions: {

		FETCH_AVALIACOES: function({ commit, state }, payload){
         
           	serviceAvaliacao.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_AVALIACOES', result);
            });

		},

		LOAD_AVALIACAO: function ({ commit }, payload) {
            var request = serviceAvaliacao.show(payload);
            request.done(function(result){
                commit('SET_AVALIACAO', result.item);
            });
		},

		ADD_AVALIACAO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceAvaliacao.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_AVALIACOES');
	 				commit('SET_AVALIACAO', result.avaliacao);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_AVALIACAO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceAvaliacao.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_AVALIACOES');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_AVALIACAO: function ({ commit, dispatch }, payload) {
            var request = serviceAvaliacao.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_AVALIACOES');
                commit('RESET_AVALIACAO');
            });
		},

		RESET_AVALIACAO: function ({ commit }) {
            commit('RESET_AVALIACAO');
		},

		SET_URL_PARAMS_AVALIACAO: function ({ commit },payload) {
            commit('SET_URL_PARAMS_AVALIACAO', payload);
		},

		RESET_DISCIPLINA_SELECIONADA: function({commit}){
			 commit('RESET_DISCIPLINA_SELECIONADA');
		}
	},

	getters: {

	}
}