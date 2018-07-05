var vuexEvento = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {
	            id_evento:'',
	            titulo:'',
			}
		},
		selected: {
            id_evento	: '',
            titulo		: '',
            descricao	: '',
            data_inicio		: '',
            hora_inicio		: '',
		},
	},

	mutations: {

	    SET_EVENTOS: function(state, payload){
	    	state.list.itens      = payload.evento.itens;
      		state.list.total      = payload.evento.total;
      		state.list.per_page   = payload.evento.per_page;
	    },

		SET_EVENTO: function(state, payload){
            state.selected.id_evento = payload.evento.id_evento	;
            state.selected.titulo    = payload.evento.titulo;
            state.selected.descricao = payload.evento.descricao;
            state.selected.data_inicio = dateToBrDate( payload.evento.inicio );
            state.selected.hora_inicio = dateTimeToTime( payload.evento.inicio );
	    },

		RESET_EVENTO: function(state){
            state.selected.id_evento 	= '';
            state.selected.titulo    	= '';
            state.selected.descricao 	= '';
            state.selected.data_inicio  = '';
            state.selected.hora_inicio  = '';
		},

	    SET_URL_PARAMS_EVENTO: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	},

	actions: {

		FETCH_EVENTOS: function({ commit, state }, payload){
         
           	serviceEvento.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_EVENTOS', result);
            });

		},

		LOAD_EVENTO: function ({ commit }, payload) {
            var request = serviceEvento.show(payload);
            request.done(function(result){
                commit('SET_EVENTO', result);
            });
		},

		ADD_EVENTO: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceEvento.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_evento = result.id
	 				dispatch('FETCH_EVENTOS');
	 				// commit('SET_EVENTO', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_EVENTO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceEvento.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_EVENTOS');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_EVENTO: function ({ commit, dispatch }, payload) {
            var request = serviceEvento.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_EVENTOS');
                commit('RESET_EVENTO');
            });
		},

		RESET_EVENTO: function ({ commit }) {
            commit('RESET_EVENTO');
		},

		RESET_SENHA: function ({ commit }) {
            commit('RESET_SENHA');
		},

		SET_URL_PARAMS_EVENTO: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_EVENTO', payload);
		}
	},

	getters: {

	}
}