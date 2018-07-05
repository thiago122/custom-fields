var vuexClasse = {
	state: {
		list: {
			total: 0,
			itens: [],
			per_page: 0,
			urlParams: {}
		},
		selected: {
            id_classe       :'',
            nm_classe       :'',
		},

	    alunos: {
	    	itens: [],
	    	total: '',
	    	alunoSelecionado: {
                id_aluno: '',
                nm_aluno: '',
                matricula: '',
                dependencia: '0',
                disciplinaDependencia: ''
	    	}
	    },
	    disciplinas:  {
	    	itens: [],
	    },
	    recuperacoes:{
	    	semNota: '',
	    },
	    avaliacoes:{
	    	semNota: '',
	    	//resumoPeriodo: ''
	    },	
	    etapas: {
	    	itens: []
	    },	    
		extras:{
			avs: '',
			periodos: '',
			resumos: [],
	    },

	    resumo: {},

		// avs:{

		// },

		// next_action: '',
		// next_action_periodo: '',

	 //    // ------ periodos: {
	 //    // ------ 	itens: []
	 //    // ------ },
	
		// DADOS PARA O FORMULÁRIO CRIAR/EDITAR CLASSE 
		formData : {
			periodo_letivo: [],
			criterio_avaliacao: [{id_criterio_avaliacao: 9, nm_criterio: 'bimestral'}], 
			serie: [],
			turno: []			
		},
	},

	mutations: {

	    SET_CLASSES: function(state, payload){
	    	state.list.itens      = payload.classe.itens;
      		state.list.total      = payload.classe.total;
      		state.list.per_page   = payload.classe.per_page;
	    },

		SET_CLASSE: function(state, payload){
			state.selected = payload
            state.selected.id_classe       = payload.id_classe ;
            state.selected.nm_classe       = payload.nm_classe ;
	    },

		RESET_CLASSE: function(state){
            state.selected.id_classe       			= '';
            state.selected.nm_classe       			= '';
            state.selected.id_criterio_avaliacao    = '';
            state.selected.id_periodo_letivo       	= '';
            state.selected.id_serie       			= '';
            state.selected.id_turno       			= '';
            state.selected.qt_vagas       			= '';

            state.selected.nm_serie       			= '';
            state.selected.nm_turno       			= '';
            state.selected.nm_periodo_letivo       	= '';
            state.selected.nm_criterio       		= '';


	    },

		SET_RESPONSAVEL_CLASSE: function(state, payload){
            state.selected.fk_responsavel = payload.id ;
            state.selected.nm_responsavel = payload.nome ;
		},

	    SET_URL_PARAMS: function(state, payload){
	    	state.list.urlParams  = payload;
	    },

// ---------------------------------------------------------
// DADOS PARA O FORMULÁRIO CRIAR/EDITAR CLASSE 
// --------------------------------------------------------- 
	    SET_PERIODO_LETIVO: function(state, payload){
	    	state.formData.periodo_letivo  = payload;
	    },

	    SET_SERIE_CLASSE: function(state, payload){
	    	state.formData.serie  = payload;
	    },

	    SET_TURNO: function(state, payload){
	    	state.formData.turno  = payload;
	    },

// ---------------------------------------------------------
// ALUNOS
// ---------------------------------------------------------
	    SET_ALUNOS_CLASSE: function(state, payload){
			state.alunos.itens = payload.itens;
			state.alunos.total = payload.total;
	    },

// ---------------------------------------------------------
// DISICPLINAS CLASSE
// ---------------------------------------------------------
	    SET_DISCIPLINAS_CLASSE: function(state, payload){
			state.disciplinas.itens = payload.itens;
	    },
	    RESET_DISCIPLINAS_CLASSE:function(state){
	    	console.log('RESET_DISCIPLINAS_CLASSE');
			state.disciplinas.itens = [];
	    },

// ---------------------------------------------------------
// RECUPERAÇÕES
// ---------------------------------------------------------

	    SET_RECUPERACOES_SEM_NOTA:function(state, payload){
			state.recuperacoes.semNota = payload;
	    },
	    RESET_RECUPERACOES_SEM_NOTA:function(state){
	    	console.log('RESET_RECUPERACOES_SEM_NOTA');
			state.recuperacoes.semNota = '';
	    },

// ---------------------------------------------------------
// RESUMOS
// ---------------------------------------------------------

	    SET_RESUMO_AVALIACOES_PERIODO:function(state, payload){
	    	if(typeof payload.resultado != "undefined"){
	    		state.resumo = payload.resultado;
	    	}
	    },

	    RESET_RESUMO: function(state){
	    	console.log('RESET_RESUMO');
	    	state.resumo = {}
	    },

// ---------------------------------------------------------
// AVALIAÇÕES
// ---------------------------------------------------------

	    SET_AVALIACOES_SEM_NOTA:function(state, payload){
			state.avaliacoes.semNota = payload;
	    },
	    RESET_AVALIACOES_SEM_NOTA:function(state){
	    	console.log('RESET_AVALIACOES_SEM_NOTA');
			state.avaliacoes.semNota = '';
	    },
// ---------------------------------------------------------
	    	    
	    SET_ETAPAS_CLASSE:function(state, payload){
			state.etapas.itens = payload.etapas;
	    },

	    SET_NEXT_ACTION_CLASSE:function(state, payload){
			state.next_action = payload;
	    },

	    SET_EXTRAS:function(state, payload){
			state.extras.avs 		= payload.avs;
			state.extras.periodos 	= payload.periodos;
			state.extras.resumos 	= payload.resumos;
	    },

	   	RESET_EXTRAS:function(state){
	   		console.log('RESET_EXTRAS');
			state.extras.avs 		= '';
			state.extras.periodos 	= '';
			state.extras.resumos 	= [];
	    },
	},

	actions: {

		FETCH_CLASSES: function({ commit, state }, payload){
         
           	serviceClasse.all(state.list.urlParams)
			.done(function(result){
            	commit('SET_CLASSES', result);
            });

		},

		LOAD_CLASSE: function ({ commit }, payload) {

			var request = serviceClasse.show(payload);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	            	resolve(result);
	                commit('SET_CLASSE', result.item);
	            });

	        });


		},

		ADD_CLASSE: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceClasse.save(state.selected);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	 				dispatch('FETCH_CLASSES');
	 				commit('SET_CLASSE', result.classe);
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		UPDATE_CLASSE: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceClasse.update(state.selected);

			return new Promise( function(resolve, reject){
				
	            request.done(function(result){
	 				dispatch('FETCH_CLASSES');
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

		REMOVE_CLASSE: function ({ commit, dispatch }, payload) {
            var request = serviceClasse.destroy(payload);
            request.done(function(result){
                dispatch('FETCH_CLASSES');
                commit('RESET_CLASSE');
            });
		},

		RESET_CLASSE: function ({ commit }) {
            commit('RESET_CLASSE');
		},

		RESET_RECUPERACOES_SEM_NOTA: function ({ commit }) {
            commit('RESET_RECUPERACOES_SEM_NOTA');
		},

		RESET_AVALIACOES_SEM_NOTA: function ({ commit }) {
            commit('RESET_AVALIACOES_SEM_NOTA');
		},

		RESET_DISCIPLINAS_CLASSE: function({ commit }){
			commit('RESET_DISCIPLINAS_CLASSE');
		},

		RESET_EXTRAS: function({ commit }){
			commit('RESET_EXTRAS');
		},

		RESET_RESUMO: function({ commit }){
			commit('RESET_RESUMO');
		},

		SET_URL_PARAMS_CLASSE: function ({ commit },payload) {
            commit('SET_URL_PARAMS', payload);
		},

		FETCH_FORM_DATA: function ({ commit },payload) {

            requestPl = servicePeriodoLetivo.all({});
            requestSerie = serviceSerie.all({});
            requestTurno = serviceTurno.all({});

            requestPl.done(function(data){
                commit('SET_PERIODO_LETIVO', data.periodo_letivo.itens);
            });

            requestSerie.done(function(data){
                commit('SET_SERIE_CLASSE', data.serie.itens);
            });

            requestTurno.done(function(data){
                commit('SET_TURNO', data.turno.itens);
            });

		},

// ----------------------------------------------------------
		LOAD_ETAPAS_CLASSE: function ({ commit }, payload) {
            var request = serviceClasse.etapas(payload);
            request.done(function(result){
                commit('SET_ETAPAS_CLASSE', result);
            });
		},

		LOAD_NEXT_ACTION_CLASSE: function({ commit }, payload){

            var request = serviceClasse.nextAction(payload);
            request.done(function(result){
                commit('SET_NEXT_ACTION_CLASSE', result.next);
            });
		},
		LOAD_EXTRAS: function({ commit }, payload){
            var request = serviceClasse.extras(payload);
            request.done(function(result){
                commit('SET_EXTRAS', result);
            });
        },

// ---------------------------------------------------------
// RESUMOS
// ---------------------------------------------------------

		LOAD_RESUMO_AVALIACOES_PERIODO: function({ commit }, payload){

            var request = serviceClasse.resumoAvaliacoesPeriodo(payload);
            request.done(function(result){
                commit('SET_RESUMO_AVALIACOES_PERIODO', result);
            });
        },

// ---------------------------------------------------------------
// ---------------------------------------------------------------
// ---------------------------------------------------------------

        ENCERRAR_CLASSE: function({ commit, dispatch }, payload){
        	console.log('------------- ENCERRAR')
            var request = serviceClasse.encerrarClasse(payload);
            request.done(function(result){
            	console.log('PAYLOAD')
            	console.log(payload)
                dispatch('LOAD_CLASSE', payload);
                dispatch('LOAD_ALUNOS_CLASSE', payload);
                
                commit('RESET_AVALIACOES_SEM_NOTA');
            }).fail(function(result){

            	console.log(result)

            	if( typeof result.responseJSON.recuperacoes_sem_nota != 'undefined'){
					commit( 'SET_RECUPERACOES_SEM_NOTA', result.responseJSON.recuperacoes_sem_nota);
            	}
            	if( typeof result.responseJSON.avaliacoes_sem_nota != 'undefined'){
					commit( 'SET_AVALIACOES_SEM_NOTA', result.responseJSON.avaliacoes_sem_nota);
            	}

            })
        },

        ATUALIZAR_APROVADOS: function({ commit, dispatch }, payload){
        	console.log('------------- ATUALIZAR APROVADOS')
            var request = serviceClasse.atualizarAprovados(payload);
            request.done(function(result){
                dispatch('LOAD_ALUNOS_CLASSE', payload);
                commit('RESET_RECUPERACOES_SEM_NOTA');
            })
        },


// ---------------------------------------------------------------
// ---------------------------------------------------------------
// ---------------------------------------------------------------

		LOAD_CALCULAR_MEDIA: function({ commit }, payload){
            var request = serviceClasse.calcularMedia(payload);
            request.done(function(result){
                commit('SET_CLASSE', result.classe);
                commit( 'RESET_AVALIACOES_SEM_NOTA');
            }).fail(function(result){

            	if( typeof result.responseJSON.recuperacoes_sem_nota != 'undefined'){
					commit( 'SET_RECUPERACOES_SEM_NOTA', result.responseJSON.recuperacoes_sem_nota);
            	}
            	if( typeof result.responseJSON.avaliacoes_sem_nota != 'undefined'){
					commit( 'SET_AVALIACOES_SEM_NOTA', result.responseJSON.avaliacoes_sem_nota);
            	}

            });
        },

		CALCULAR_MEDIA_FINAL: function({ commit, dispatch }, payload){
            var request = serviceClasse.calcularMediaFinal(payload);
            request.done(function(result){
                dispatch('LOAD_CLASSE', payload);
                dispatch('LOAD_ALUNOS_CLASSE', payload);
            });
        },
// ---------------------------------------------------

// ---------------------------------------------------------
// ALUNOS
// ---------------------------------------------------------
		LOAD_ALUNOS_CLASSE: function ({ commit }, payload) {
            var request = serviceAlunosClasse.all(payload);
            request.done(function(result){
                commit('SET_ALUNOS_CLASSE', { itens: result.aluno.itens, total:result.aluno.total });
            });
		},

		REMOVE_ALUNO_CLASSE: function({ commit, dispatch, state }, payload){

            var request = serviceAlunosClasse.destroy(payload);
            request.done(function(result){
 				dispatch('LOAD_ALUNOS_CLASSE', {id_classe: state.selected.id_classe});
            	// Falta o reset Alunos Para adicionar
            });
		},

		ADD_ALUNO_CLASSE: function({ commit, dispatch, state }, payload){
			// https://stackoverflow.com/questions/40165766/returning-promises-from-vuex-actions
            var request = serviceAlunosClasse.save(payload);

			return new Promise( function(resolve, reject){

	            request.done(function(result){
	 				dispatch('LOAD_ALUNOS_CLASSE', {id_classe: state.selected.id_classe});
	            	resolve(result);
	            }).fail(function(dddd){
	            	resolve(dddd);
	            });

	        });
		},

// ---------------------------------------------------------
// DISCIPLINAS
// ---------------------------------------------------------
		LOAD_DISCIPLINAS_CLASSE: function ({ commit }, payload) {
            var request = serviceDisciplinasClasse.all(payload);
            request.done(function(result){
                commit('SET_DISCIPLINAS_CLASSE', { itens: result.itens});
            });
		},

		UPDATE_DISCIPLINA_CLASSE: function ({ commit, dispatch }, payload) {
	        
	        var request = serviceDisciplinasClasse.update(payload);

			return new Promise( function(resolve, reject){
	            request.done(function(result){
	                dispatch('LOAD_DISCIPLINAS_CLASSE', payload);
	                resolve(result);
	            });
	        });

		},

		SAVE_DISCIPLINA_CLASSE: function ({ commit, dispatch }, payload) {

            var request = serviceDisciplinasClasse.save(payload);

			return new Promise( function(resolve, reject){
	            request.done(function(result){
	                dispatch('LOAD_DISCIPLINAS_CLASSE', payload);
	                resolve(result);	            
	            });
	        });

		},

		REMOVE_DISCIPLINAS_CLASSE: function ({ commit, dispatch }, payload) {
            var request = serviceDisciplinasClasse.destroy(payload);
            request.done(function(result){
	            dispatch('LOAD_DISCIPLINAS_CLASSE', payload);
            });
		},


	},

	getters: {

	}
}