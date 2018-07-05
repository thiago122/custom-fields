var vuexAlunos = {
	
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_aluno       :'',
            nm_aluno       :'thiago',
            nm_pai         :'asd',
            nm_mae         :'asd',
            dt_nascimento  :'asd',
            uf             :'as',
            municipio      :'as',
            bairro         :'',
            logradouro     :'asd',
            numero         :'asd',
            complemento    :'as',
            matricula      :'asd',
            num_seg_saude  :'asd',
            fk_responsavel : '',
            nm_responsavel : ''
		},
		classesAluno: []

	},

	mutations: {

	    SET_ALUNOS: function(state, payload){
	    	state.list.itens      = payload.aluno.itens;
      		state.list.total      = payload.aluno.total;
      		state.list.per_page   = payload.aluno.per_page;
	    },

		SET_ALUNO: function(state, payload){
			state.selected = payload

            state.selected.id_aluno       = payload.id_aluno ;
            state.selected.nm_aluno       = payload.nm_aluno ;
            state.selected.nm_pai         = payload.nm_pai ;
            state.selected.nm_mae         = payload.nm_mae ;
            state.selected.dt_nascimento  = brDateToDate( payload.dt_nascimento );
            state.selected.uf             = payload.uf ;
            state.selected.municipio      = payload.municipio ;
            state.selected.bairro         = payload.bairro ;
            state.selected.logradouro     = payload.logradouro ;
            state.selected.numero         = payload.numero ;
            state.selected.complemento    = payload.complemento ;
            state.selected.matricula      = payload.matricula ;
            state.selected.num_seg_saude  = payload.num_seg_saude ;
            state.selected.fk_responsavel = payload.fk_responsavel ;
            state.selected.nm_responsavel = payload.nm_responsavel ;

	    },

		RESET_ALUNO: function(state){

            state.selected.id_aluno       = '';
            state.selected.nm_aluno       = '';
            state.selected.nm_pai         = '';
            state.selected.nm_mae         = '';
            state.selected.dt_nascimento  = '';
            state.selected.uf             = '';
            state.selected.municipio      = '';
            state.selected.bairro         = '';
            state.selected.logradouro     = '';
            state.selected.numero         = '';
            state.selected.complemento    = '';
            state.selected.matricula      = '';
            state.selected.num_seg_saude  = '';
            state.selected.fk_responsavel = '';
            state.selected.nm_responsavel = '';

	    },

		SET_RESPONSAVEL_ALUNO: function(state, payload){
            state.selected.fk_responsavel = payload.id ;
            state.selected.nm_responsavel = payload.nome ;
		},

	    SET_URL_PARAMS: function(state, payload){
	    	state.list.urlParams  = payload;
	    },

	   	SET_CLASSES_ALUNO: function(state, payload){
	    	state.classesAluno = payload;
	    },
	},

	actions: {

		FETCH_ALUNOS: function({ commit, state }, payload){
         
           	serviceAlunos.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_ALUNOS', result);
            });

		},

		LOAD_ALUNO: function ({ commit }, payload) {
            var request = serviceAlunos.show(payload);
            request.done(function(result){
                commit('SET_ALUNO', result.item);
            });
		},

		ADD_ALUNO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceAlunos.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_ALUNOS');
	 				commit('SET_ALUNO', result.aluno);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_ALUNO: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceAlunos.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	            	console.log( result )
	 				dispatch('FETCH_ALUNOS');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_ALUNO: function ({ commit, dispatch }, payload) {
            var request = serviceAlunos.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_ALUNOS');
                commit('RESET_ALUNO');
            });
		},

		RESET_ALUNO: function ({ commit }) {
            commit('RESET_ALUNO');
		},

		SET_RESPONSAVEL_ALUNO: function ({ commit },payload) {
            commit('SET_RESPONSAVEL_ALUNO', payload);
		},

		SET_URL_PARAMS: function ({ commit },payload) {
            commit('SET_URL_PARAMS', payload);
		},

		FETCH_CLASSES_ALUNO: function ({ commit }, payload) {
            var request = serviceAlunos.classes(payload);
            request.done(function(result){
                commit('SET_CLASSES_ALUNO', result.classes);
            });
		},
	},

	getters: {

	}
}