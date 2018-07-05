var vuexTipoAvaliacao = {
	
	state: {
		list: {
			total: 0,
			itens: [],
		}
	},

	mutations: {

	    SET_TIPOS_AVALIACAO: function(state, payload){
	    	state.list.itens      = payload.itens;
	    },

	    SET_URL_PARAMS_TIPO_AVALIACAO: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	},

	actions: {

		FETCH_TIPOS_AVALIACAO: function({ commit, state }, payload){
         
           	serviceTipoAvaliacao.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_TIPOS_AVALIACAO', result);
            });

		}
	}
		
}