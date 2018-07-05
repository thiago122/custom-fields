var vuexCurso = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_curso      :'',
            nm_curso      :'',
		},

	},

	mutations: {

	    SET_CURSOS: function(state, payload){
	    	state.list.itens      = payload.itens;
      		state.list.total      = payload.total;
      		state.list.per_page   = payload.per_page;
	    },

		SET_CURSO: function(state, payload){
            state.selected.id_curso = payload.id_curso;
            state.selected.nm_curso = payload.nm_curso;
	    },

		RESET_CURSO: function(state){
            state.selected.id_curso = '';
            state.selected.nm_curso = '';   
		},

	    SET_URL_PARAMS_CURSO: function(state, payload){
	    	state.list.urlParams  = payload;
	    }
	},

	actions: {

		FETCH_CURSOS: function({ commit, state }, payload){
         
           	serviceCurso.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_CURSOS', result);
            });

		},

		LOAD_CURSO: function ({ commit }, payload) {
            var request = serviceCurso.show(payload);
            request.done(function(result){
                commit('SET_CURSO', result.item);
            });
		},

		ADD_CURSO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceCurso.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_CURSO');
	 				commit('SET_CURSO', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_CURSO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceCurso.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_CURSO');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_CURSO: function ({ commit, dispatch }, payload) {
            var request = serviceCurso.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_CURSO');
                commit('RESET_CURSO');
            });
		},

		RESET_CURSO: function ({ commit }) {
            commit('RESET_CURSO');
		},

		RESET_SENHA: function ({ commit }) {
            commit('RESET_SENHA');
		},

		SET_URL_PARAMS_CURSO: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_CURSO', payload);
		},

	},

	getters: {

	}
}