var vuexNotificacao = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {
	            id_notificacao:'',
	            titulo:'',
			}
		},
		selected: {
            id_notificacao	: '',
            id_tipo_notificacao		: '', 
            titulo			: '',
            mensagem		: '',
            destinatarios 	: [], // ids
            created_at		: '',
            para			: '',
            id  			: '' // id do aluno( individual ) ou id_classe quando for por classe
		},

		destinatarios: [], // lista
		tipo_notificacao: []
	},

	mutations: {

	    SET_NOTIFICACOES: function(state, payload){
	    	state.list.itens      = payload.notificacao.itens;
      		state.list.total      = payload.notificacao.total;
      		state.list.per_page   = payload.notificacao.per_page;
	    },

		SET_NOTIFICACAO: function(state, payload){
            state.selected.id_notificacao = payload.notificacao.id_notificacao	;
            state.selected.titulo    	  = payload.notificacao.titulo;
            state.selected.mensagem 	  = payload.notificacao.mensagem;
            state.selected.created_at 	  = payload.notificacao.created_at;
            state.selected.para 	  	  = payload.notificacao.para;
	    },

		SET_TIPO_NOTIFICACAO: function(state, payload){
            state.tipo_notificacao = payload.tipo	;
	    },

	    SET_ID: function(state, payload){
            state.selected.id = payload;
	    },

		RESET_NOTIFICACAO: function(state){
            state.selected.id_notificacao 	= '';
            state.selected.titulo    	= '';
            state.selected.mensagem 	= '';
			state.selected.created_at	= '',
            state.selected.para			= '',
            state.selected.id  			= ''
		},

		RESET_DESTINATARIOS: function(state){
			console.log('RESET_DESTINATARIOS')
            state.selected.id = '';
            state.destinatarios = [];
            state.selected.destinatarios = [];
		},

		SET_DESTINATARIOS: function(state, payload){
			console.log('SET_DESTINATARIOS')
            payload.forEach(function(item){
            	state.destinatarios.push(item);
            	state.selected.destinatarios.push(item.id_usuario);
            });
		},

	    SET_URL_PARAMS_NOTIFICACOES: function(state, payload){
	    	state.list.urlParams  = payload;
	    },
	},

	actions: {

		FETCH_NOTIFICACOES: function({ commit, state }, payload){
         
           	serviceNotificacao.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_NOTIFICACOES', result);
            });
		},

		LOAD_NOTIFICACAO: function ({ commit }, payload) {
            var request = serviceNotificacao.show(payload);
            request.done(function(result){
                commit('SET_NOTIFICACAO', result);
                commit('SET_DESTINATARIOS', result.destinatarios);
            });
		},

		LOAD_TIPO_NOTIFICACAO: function ({ commit }, payload) {
            var request = serviceNotificacao.tipo();
            request.done(function(result){
                commit('SET_TIPO_NOTIFICACAO', result);
            });
		},

		NOTFI_LOAD_ALUNOS_CLASSE: function ({ commit }, payload) {
            var request = serviceAlunosClasse.all(payload);      
            request.done(function(result){
            	console.log("LOAD CLASSE")
                commit('SET_ID', payload.id_classe);
                commit('SET_DESTINATARIOS', result.aluno.itens);
            });
		},

		NOTFI_LOAD_ALUNO: function ({ commit }, payload) {
            var request = serviceAlunos.show(payload);
            request.done(function(result){
            	console.log("LOAD ALUNO")

            	var alunos = [];
            	alunos.push(result.item);

            	commit('SET_ID', payload.id_aluno);
                commit('SET_DESTINATARIOS', alunos);

            });
		},

		ADD_NOTIFICACAO: function({ commit, dispatch, state }, payload){
			var self = this;
            var request = serviceNotificacao.save(state.selected);
            console.log(state.selected)
			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	state.selected.id_notificacao = result.id
	            	
	            	dispatch('LOAD_NOTIFICACAO',{id_notificacao: result.id});
	 				dispatch('FETCH_NOTIFICACOES');
	 				// commit('SET_NOTIFICACAO', result.responsavel);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_NOTIFICACAO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceNotificacao.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_NOTIFICACOES');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_NOTIFICACAO: function ({ commit, dispatch }, payload) {
            var request = serviceNotificacao.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_NOTIFICACOES');
                commit('RESET_NOTIFICACAO');
            });
		},

		RESET_NOTIFICACAO: function ({ commit }) {
            commit('RESET_NOTIFICACAO');
            
		},

		RESET_DESTINATARIOS: function({ commit }){
			commit('RESET_DESTINATARIOS');	
		},

		SET_URL_PARAMS_NOTIFICACOES: function ({ commit,state },payload) {
            commit('SET_URL_PARAMS_NOTIFICACOES', payload);
		}
	},

	getters: {

	}
}