var vuexSerie = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_serie      :'',
            nm_serie      :'',
            id_curso      :'',
		  	situacao_serie: 0,
		  	disciplinas_serie: [],
		},

	},

	mutations: {

	    SET_SERIES: function(state, payload){
	    	state.list.itens      = payload.serie.itens;
      		state.list.total      = payload.serie.total;
      		state.list.per_page   = payload.serie.per_page;
	    },

		SET_SERIE: function(state, payload){
            state.selected.id_serie   			= payload.serie.id_serie;
            state.selected.nm_serie   			= payload.serie.nm_serie;
		  	state.selected.id_curso				= payload.serie.id_curso;
		  	state.selected.nm_curso				= payload.serie.nm_curso;
		  	state.selected.situacao_serie		= payload.serie.situacao_serie;
		  	state.selected.disciplinas_serie	= payload.disciplinas_serie;
	    },

		RESET_SERIE: function(state){
            state.selected.id_serie   			= '';
            state.selected.nm_serie   			= '';
		  	state.selected.id_curso				= '';
		  	state.selected.nm_curso				= '';
		  	state.selected.situacao_serie		= '';
		  	state.selected.disciplinas_serie	= [];    
		},

	    SET_URL_PARAMS_SERIE: function(state, payload){
	    	state.list.urlParams  = payload;
	    },

        CHECK_DISCIPLINA: function(state, payload){
            var index = state.selected.disciplinas_serie.indexOf( payload.id );

            if (index === -1) {
                state.selected.disciplinas_serie.push(payload.id);
            }else{
                state.selected.disciplinas_serie.splice(index, 1);
            }
        }
	},

	actions: {

		FETCH_SERIES: function({ commit, state }, payload){
         
           	serviceSerie.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_SERIES', result);
            });

		},

		LOAD_SERIE: function ({ commit }, payload) {
            var request = serviceSerie.show(payload);
            request.done(function(result){
                commit('SET_SERIE', result);
            });
		},

		LOAD_SERIE_EDIT: function ({ commit }, payload) {
            var request = serviceSerie.edit(payload);
            request.done(function(result){
                commit('SET_SERIE', result);
            });
		},

		ADD_SERIE: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceSerie.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_serie = result.id
	 				dispatch('FETCH_SERIES');
	 				commit('SET_SERIE', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_SERIE: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceSerie.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_SERIES');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_SERIE: function ({ commit, dispatch }, payload) {
            var request = serviceSerie.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_SERIES');
                commit('RESET_SERIE');
            });
		},

		RESET_SERIE: function ({ commit }) {
            commit('RESET_SERIE');
		},

		RESET_SENHA: function ({ commit }) {
            commit('RESET_SENHA');
		},

		SET_URL_PARAMS_SERIE: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_SERIE', payload);
		},
        CHECK_DISCIPLINA: function({ commit },payload){
            commit('CHECK_DISCIPLINA', payload);
        }
	},

	getters: {
		// 'DISCIPLINAS_SERIE' : function(state, getters){

		// 	$disciplinas = [];

		// 	if(state.selected.disciplinas.length > 0){

		// 		state.selected.disciplinas.forEach(function(item){
		// 			var index = state.selected.disciplinas_serie.indexOf( item.id_disciplina );
		// 			item.checked = false;
		// 			if(index !== -1){
		// 				item.checked = true;
		// 			}
		// 			$disciplinas.push(item);
		// 		});

		// 	}

		// 	return $disciplinas;
		// }
	}
}