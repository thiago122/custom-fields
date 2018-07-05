var vuexRecepcao = {

	state: {

		// --------
        dadosBasicos: {
            dataAtual: '',
            clinicas: [],
            horarios: [],
            tiposEspecialidade: [],
            statusAtendimento: [],
            duracao: {}
        },

        clinica: {
            idClinica:'',
            horariosClinica: [],
            profissionaisClinica: [],
            especialidadesClinica: [],
        },

        atendimentos: [], // atendimentos da grade

        atendimentosDataSelecionada: [],

        // GRADE
        grade: [],
        filtroGrade: {
            status: [],
            especialidade: '',
            nm_agendante: '',
        },

        // -----
        idTipoEspecialidade: '',

        // dias do mes com consulta
        diasComConsulta: [],

        // busca por usuario
        urlBuscaUsuario:            base_url + 'admin/atendimento/Recepcao/buscaUsuario',
        urlBuscaAtendimentoUsuario: base_url + 'admin/atendimento/Atendimento/buscaUsuario/',

        // exibindoStatusAtendimento: false,
        exibirCalendario: false,

        resultadoPesquisa: [],

        // atendimento
        atendimento: {
            modoEdicao: false,
            tipo_edicao: 'especialidade', // especialidade ou profissional
            especialidades: [],

            avatar_profissional: {
                ogiginal: '',
                mini: '',
                media: '',
                grande: '',
            },

            agendante: {
                nm_usuario: '',
                cpf:        '',
                rg:         '',
                fixo:       '',
                celular:    '',
            },

            // atendimento
            data: '',
            inicio: '',
            fim: '',

            id_atendimento: '',
            id_atendimento_retorno: '',

            nm_profissional: '',

            id_especialidade: '',
            nm_especialidade: '',

            id_profissional: '',

            id_status_atendimento: '',
            nm_status_atendimento: '',
            class_css: '',
            exadecimal_cor: '',

            id_usuario_agendante: '',

            inicio_atendimento: '',
            fim_atendimento: '',

            inicio_espera: '',
            fim_espera: '',

            agendado_em: '',

            inicio_agendamento: '',
            fim_agendamento: '',

            obs_atendimento: '',
            duracao: '',

        },

        fila: {
            itens: [],
            filtro:{
                tipoEspecialidade: 1,
                status: [],
                profissional: '',
                especialidade: [],
                nm_agendante: '',
            }
        },

        pesquisaAtendimento: {
            agendante:{
                usuario: {}
            }


        }



        // --------

	},

	mutations: {

        SET_AGENDANTE_PESQUISA_ATENDIMENTO: function( state, usuario ){
            state.pesquisaAtendimento.agendante.usuario = usuario
        },

        RESET_AGENDANTE_PESQUISA_ATENDIMENTO: function( state ){
            state.pesquisaAtendimento.agendante.usuario = {}
        },

        RESET_ATENDIMENTO: function(state){
            state.atendimento.agendante.nm_usuario   = '';
            state.atendimento.agendante.cpf          = '';
            state.atendimento.agendante.rg           = '';
            state.atendimento.agendante.fixo         = '';
            state.atendimento.agendante.celular      = '';
            state.atendimento.agendante.telefone     = '';
            state.atendimento.id_usuario_agendante   = '';

            state.atendimento.avatar_profissional.ogiginal = '';
            state.atendimento.avatar_profissional.mini = '';
            state.atendimento.avatar_profissional.media = '';
            state.atendimento.avatar_profissional.grande = '';
            state.atendimento.nm_status_atendimento  = '';
            state.atendimento.class_css              = '';
            state.atendimento.exadecimal_cor         = '';
            state.atendimento.especialidades         = [];
            state.atendimento.data                   = '';
            state.atendimento.inicio                 = '';
            state.atendimento.fim                    = '';
            state.atendimento.id_atendimento         = '';
            state.atendimento.id_atendimento_retorno = '';
            state.atendimento.nm_profissional        = '';
            state.atendimento.id_especialidade       = '';
            state.atendimento.id_profissional        = '';
            state.atendimento.nm_especialidade        = '';
            state.atendimento.status_atendimento_id  = '';
            state.atendimento.inicio_atendimento     = '';
            state.atendimento.fim_atendimento        = '';
            state.atendimento.inicio_espera          = '';
            state.atendimento.fim_espera             = '';
            state.atendimento.agendado_em            = '';
            state.atendimento.inicio_agendamento     = '';
            state.atendimento.fim_agendamento        = '';
            state.atendimento.obs_atendimento        = '';
            state.atendimento.duracao                = '';
        },


        SET_ATENDIMENTOS: function(state, payload){
            state.atendimentos = payload;
        },

        ADD_ATENDIMENTO: function(state, payload){
            state.atendimentos.push(payload) ;
        },

        SET_PROFISSIONAIS_CLINICA: function(state, payload){
            state.clinica.profissionaisClinica = payload;
        },

        SET_ESPECIALIDADES_CLINICA: function(state, payload){
            state.clinica.especialidadesClinica = payload;
        },

        SET_DADOS_BASICOS: function(state, payload){
            state.dadosBasicos.dataAtual          = payload.dataAtual;
            state.dadosBasicos.clinicas           = payload.clinicas;
            state.dadosBasicos.tiposEspecialidade = payload.tiposEspecialidade;
            state.dadosBasicos.horarios           = payload.horarios;
            state.dadosBasicos.statusAtendimento  = payload.statusAtendimento;
            state.dadosBasicos.duracao            = payload.duracao;
        },

        SET_GRADE: function(state, payload){
            state.grade = payload;
        },

        SET_ITENS_FILA: function(state, payload){
            state.fila.itens = payload;
        },

        SET_TIPO_ESPECIALIDADE_FILA: function(state, payload){
            state.fila.filtro.tipoEspecialidade = payload;
        },

        // reset
        RESET_FILTRO_NOME: function(state){
            state.fila.filtro.nm_agendante = '';
        },

        RESET_FILTRO_FILA_NOME: function(state){
            state.filtroGrade.nm_agendante = '';
        },

        RESET_FILTRO_FILA_STATUS: function(state){
            state.filtroGrade.status = [];
        },

        RESET_FILTRO_FILA_ESPECIALIDADE: function(state){
            state.filtroGrade.especialidade = '';
        },

        SET_STATUS_ATENDIMENTO: function( state, payload ){
            state.atendimento.id_status_atendimento  = payload.id_status_atendimento;
            state.atendimento.nm_status_atendimento  = payload.nm_status_atendimento;
            state.atendimento.exadecimal_cor         = payload.exadecimal_cor;
            state.atendimento.class_css              = payload.class_css;
        },

        SET_TODOS_STATUS_ATENDIMENTO_FILA: function(state, payload ){

            var fila = [];

            state.dadosBasicos.statusAtendimento.forEach(function(status){
                fila.push(status.id_status_atendimento);
            });

            state.fila.filtro.status = fila;
        },

        SET_PROFISSIONAL_ATENDIMENTO: function( state, profissional){
            state.atendimento.nm_profissional = profissional.nm_profissional;
            state.atendimento.id_profissional = profissional.id_profissional;
            state.atendimento.avatar_profissional = profissional.avatar;
            state.atendimento.especialidades  = profissional.especialidades;
        },

        SET_HORARIOS_ATENDIMENTO: function(state, atendimento){
            state.atendimento.inicio = moment( atendimento.inicio_agendamento ).format('HH:mm') ;
            state.atendimento.fim    = moment( atendimento.fim_agendamento ).format('HH:mm') ;
        },

        SET_DATA_ATENDIMENTO: function(state, data){
            state.atendimento.data = data;
        },

        SET_ESPECIALIDADE_ATENDIMENTO: function(state, atendimento){
            state.atendimento.id_especialidade = atendimento.id_especialidade;
            state.atendimento.nm_especialidade = atendimento.nm_especialidade;
        },

        SET_CLINICA_ATENDIMENTO: function(state, atendimento){
            state.atendimento.clinica_id = atendimento.clinica_id;
        },

        SET_ID_ATENDIMENTO: function(state, atendimento){
            state.atendimento.id_atendimento = atendimento.id_atendimento;
        },

        SET_AGENDANTE_ATENDIMENTO: function(state, usuario){
            console.log('SET USUARIO AGENDANTE')
            // state.atendimento.usuario_agendante_id = usuario.id_usuario;
            state.atendimento.id_usuario_agendante = usuario.id_usuario;
            state.atendimento.agendante.nm_usuario = usuario.nm_usuario;
            state.atendimento.agendante.cpf        = usuario.cpf;
            state.atendimento.agendante.rg         = usuario.rg;
            state.atendimento.agendante.fixo       = usuario.fixo;
            state.atendimento.agendante.celular    = usuario.celular;
            state.atendimento.agendante.avatar     = usuario.avatar;
        },

        RESET_AGENDANTE_ATENDIMENTO: function(state, usuario){
            console.log('RESET USUARIO AGENDANTE')
            state.atendimento.id_usuario_agendante = '';
            state.atendimento.agendante.nm_usuario = '';
            state.atendimento.agendante.cpf        = '';
            state.atendimento.agendante.rg         = '';
            state.atendimento.agendante.fixo       = '';
            state.atendimento.agendante.celular    = '';
            state.atendimento.agendante.avatar     = '';
        },

        SET_PRE_CADASTRO: function(state, atendimento){
            console.log('SET_PRE_CADASTRO')
            state.atendimento.agendante.nm_usuario = atendimento.nome;
            state.atendimento.agendante.celular    = atendimento.telefone;
        },

        REPLACE_ATENDIMENTO: function(state, novo){
            console.log('REPLACE_ATENDIMENTO');
            state.atendimentos.forEach(function(atendimento, index){
                if(atendimento.id_atendimento == novo.id_atendimento ){
                    state.atendimentos[index] =  novo;
                }
            });
        },

        SET_DIAS_COM_CONSULTAS_MES: function(state, dias){
            state.diasComConsulta = dias;
        },

        SET_ATENDIMENTOS_DATA_SELECIONADA: function(state, atendimentos){
            state.atendimentosDataSelecionada = atendimentos;
        },

        RESET_ATENDIMENTOS_DATA_SELECIONADA: function(state, atendimentos){
            state.atendimentosDataSelecionada = [];
        },

        SET_DADOS_BASICOS_EDICA_ATENDIMENTO: function(state, dias){
            state.diasComConsulta = dias;
        },

        SET_TIPO_EDICAO: function(state, tipo){
            state.atendimento.tipo_edicao = tipo;
        },

        SET_MODO_EDICAO: function(state, modo){
            state.atendimento.modoEdicao = modo;
        },

	},

	actions: {

        SET_AGENDANTE_PESQUISA_ATENDIMENTO: function( {commit}, usuario ){
            console.log('SET_AGENDANTE_PESQUISA_ATENDIMENTO')
            commit('SET_AGENDANTE_PESQUISA_ATENDIMENTO', usuario)
        },

        RESET_AGENDANTE_PESQUISA_ATENDIMENTO: function( {commit} ){
            console.log('RESET_AGENDANTE_PESQUISA_ATENDIMENTO')
            commit('RESET_AGENDANTE_PESQUISA_ATENDIMENTO')
        },
        // --------------------------------------------------

        FETCH_DADOS_BASICOS: function({commit}){
            log('FETCH_DADOS_BASICOS')

            var self = this;
            var request = serviceAtendimento.config();

            request.done(function(result){
                commit('SET_DADOS_BASICOS',result.data);
                commit('SET_TODOS_STATUS_ATENDIMENTO_FILA');
            });
        },

        FETCH_ATENDIMENTOS_DIA: function({ commit, state, dispatch  }, payload){
            log('FETCH_ATENDIMENTOS_DIA')

            var dados = {
                data:       state.dadosBasicos.dataAtual,
                id_clinica: state.clinica.idClinica
            }

            var request = serviceAtendimento.all(dados);

            return new Promise( function(resolve, reject){

                request.done(function(result){

                    resolve(result);

                    commit('SET_ATENDIMENTOS',              result.data.atendimentos);
                    commit('SET_PROFISSIONAIS_CLINICA',     result.data.profissionais_clinica);
                    commit('SET_ESPECIALIDADES_CLINICA',    result.data.especialidades_clinica);

                    dispatch('PROCESSAR_PROFISSIONAIS');
                    dispatch('COMPILAR_GRADE');
                    dispatch('COMPILAR_FILA');


                });

            });

        },

        RESET_ATENDIMENTOS_DATA_SELECIONADA: function({ commit, state, dispatch  }){
            log('RESET_ATENDIMENTOS_DATA_SELECIONADA')
            commit('RESET_ATENDIMENTOS_DATA_SELECIONADA')
        },

        FETCH_ATENDIMENTOS_DATA_SELECIONADA: function({ commit, state, dispatch  }, payload){

            log('FETCH_ATENDIMENTOS_DATA_SELECIONADA')

            var request = serviceAtendimento.atendimentosDia(payload);

            request.done(function(response){

                // var atendimentos = [];
                // response.data.atendimentos.forEach(function(atendimento){
                //     atendimentos.push(padronizarObjetoAtendimento(atendimento));
                // });
                // commit('SET_ATENDIMENTOS_DATA_SELECIONADA', atendimentos);

                dispatch('_PROCESSAR', response);
            });

        },

        FETCH_ATENDIMENTOS_USUARIO: function({ commit, state, dispatch  }, payload){

            log('FETCH_ATENDIMENTOS_USUARIO')

            var request = serviceAtendimento.atendimentosUsuario(payload);

            request.done(function(response){
                dispatch('_PROCESSAR', response);
            });

        },


        _PROCESSAR: function({ commit, state, dispatch  },atendimentoEncontrados){
            console.log(atendimentoEncontrados)
            var atendimentos = [];

            atendimentoEncontrados.data.atendimentos.forEach(function(atendimento){
                atendimentos.push(padronizarObjetoAtendimento(atendimento));
            });

            commit('SET_ATENDIMENTOS_DATA_SELECIONADA', atendimentos);
        },



        SET_TIPO_ESPECIALIDADE_FILA: function({ commit, state, dispatch  }, payload){
            log('SET_TIPO_ESPECIALIDADE_FILA')
            commit('SET_TIPO_ESPECIALIDADE_FILA', payload);
        },

// --------------------------------------------------------------------
// PESQUISA DOS ATENDIMENTOS
// --------------------------------------------------------------------

        FETCH_DIAS_COM_CONSULTAS_MES: function({ commit, state}, payload){

            log('FETCH_DIAS_COM_CONSULTAS_MES')

            var self = this;

            var dados = {
                mes: payload.mes,
                ano: payload.ano,
                id_especialidade: payload.id_especialidade,
                id_profissional: payload.id_profissional,
                status: payload.status,
            }

            var request = serviceAtendimento.diasMes(dados);

            request.done(function(response){
                commit('SET_DIAS_COM_CONSULTAS_MES', response.data.dias);
            });
        },

// --------------------------------------------------------------------
// GRADE
// --------------------------------------------------------------------

        ATUALIZAR_GRADE:function({commit, dispatch}){
            log('ATUALIZAR_GRADE')
            dispatch('PROCESSAR_PROFISSIONAIS');
            dispatch('COMPILAR_GRADE');
            dispatch('COMPILAR_FILA');
        },

// --------------------------------------------------------------------
// ATENDIMENTO
// --------------------------------------------------------------------

        RESET_ATENDIMENTO: function( { commit, state}, payload ){
            log('RESET_ATENDIMENTO')
            commit('RESET_ATENDIMENTO')
        },

        SET_PROFISSIONAL_ATENDIMENTO: function({ commit, state}, idProfissional){
            log('SET_PROFISSIONAL_ATENDIMENTO')
            var profissionaisClinica = JSON.parse( JSON.stringify( state.clinica.profissionaisClinica ) )

            profissionalSelecionado = _.find(profissionaisClinica, function(o) {
                return o.id_profissional == idProfissional;
            });

            if( profissionalSelecionado ){
                commit('SET_PROFISSIONAL_ATENDIMENTO', profissionalSelecionado);
            }

        },

        SET_HORARIOS_ATENDIMENTO: function({ commit, state}, atendimento){
            log('SET_HORARIOS_ATENDIMENTO')
            commit('SET_HORARIOS_ATENDIMENTO', atendimento);
        },

        SET_DATA_ATENDIMENTO: function({ commit, state}, atendimento){

            log('SET_DATA_ATENDIMENTO');

            if( typeof atendimento.inicio_agendamento != 'undefined' ){
                data = moment(atendimento.inicio_agendamento ).format('DD/MM/YYYY');

                console.log(data);
                commit('SET_DATA_ATENDIMENTO', data);
                return false;
            }else{
                if(atendimento.split('/').length == 3){

                    console.log(data);
                    commit('SET_DATA_ATENDIMENTO', atendimento);
                    return false;
                }

                if(atendimento.split('-').length == 3){
                    var dt = atendimento.split('-');
                    data = dt[2]+'/'+dt[1]+'/'+dt[0];

                    console.log(data);
                    commit('SET_DATA_ATENDIMENTO', data);
                    return false;
                }
            }

            alert('data em formato errado')

        },

        SET_TIPO_EDICAO: function({ commit, state}, tipo){
            commit('SET_TIPO_EDICAO', tipo);
        },

        SET_ESPECIALIDADE_ATENDIMENTO: function({ commit, state}, atendimento){
            log('SET_ESPECIALIDADE_ATENDIMENTO')
            commit('SET_ESPECIALIDADE_ATENDIMENTO', atendimento);
        },

        SET_CLINICA_ATENDIMENTO: function({ commit, state}, atendimento){
            log('SET_CLINICA_ATENDIMENTO')
            commit('SET_CLINICA_ATENDIMENTO', atendimento);
        },

        SET_ID_ATENDIMENTO: function({ commit, state}, atendimento){
            log('SET_ID_ATENDIMENTO')
            commit('SET_ID_ATENDIMENTO', atendimento);
        },

        SET_AGENDANTE_ATENDIMENTO: function({ commit, state}, usuario){
            log('SET_AGENDANTE_ATENDIMENTO');

            usuario.nm_usuario = usuario.nm_agendante || usuario.nm_usuario;
            usuario.id_usuario = usuario.usuario_agendante_id || usuario.id_usuario;
            usuario.avatar     = usuario.avatar;

            commit('SET_AGENDANTE_ATENDIMENTO', usuario);
        },

        RESET_AGENDANTE_ATENDIMENTO: function({ commit, state}, usuario){
            log('RESET_AGENDANTE_ATENDIMENTO');
            commit('RESET_AGENDANTE_ATENDIMENTO', usuario);
        },

        SAVE_ATENDIMENTO: function({ commit, state, dispatch}, payload){
            log('SAVE_ATENDIMENTO');
            var dados = prepararAtendimentoParaSalvar({ commit, state}, payload);
            dispatch('_SAVE', dados);
        },

        _SAVE: function({ commit, state, dispatch}, payload){
            log('_SAVE');
            var self = this;
            var request = serviceAtendimento.save(payload);

            request.done(function(result){
                commit('REPLACE_ATENDIMENTO', result.data.atendimento)
                commit('ADD_ATENDIMENTO', result.data.atendimento );
                commit('SET_ID_ATENDIMENTO', result.data.atendimento)
                dispatch('ATUALIZAR_GRADE');
            });

        },

        UPDATE_ATENDIMENTO: function({ commit, state, dispatch}, payload){
            log('UPDATE_ATENDIMENTO');
            var dados = prepararAtendimentoParaSalvar({ commit, state}, payload);
            dispatch('_UPDATE', dados);
        },

        _UPDATE: function({ commit, state, dispatch}, payload){
            log('_UPDATE');

            payload.id_atendimento = state.atendimento.id_atendimento;

            var request = serviceAtendimento.update(payload);

            request.done(function(result){
                commit('REPLACE_ATENDIMENTO',result.data.atendimento);
                dispatch('ATUALIZAR_GRADE');
            });
            request.fail(function(result){

            });
        },

        // ------------------------------------------------------
        //
        // ------------------------------------------------------

        EXIBIR_MODAL_ATENDIMENTO: function(){
            $("#modal-atendimento").modal('show');
        },

        OCULTAR_MODAL_ATENDIMENTO: function(){
            $("#modal-atendimento").modal('hide');
        },

        SET_MODO_EDICAO: function({commit}){
            commit('SET_MODO_EDICAO', true);
        },

        RESET_MODO_EDICAO: function({commit}){
           commit('SET_MODO_EDICAO', false);
        },

        ATENDIMENTO_VASIO: function({ commit, state, dispatch}, atendimento){

            var atendimento = JSON.parse( JSON.stringify( atendimento ) );

            dispatch('RESET_ATENDIMENTO');
            dispatch('SET_PROFISSIONAL_ATENDIMENTO', atendimento.id_profissional );
            dispatch('SET_HORARIOS_ATENDIMENTO', atendimento );
            dispatch('SET_DATA_ATENDIMENTO', state.dadosBasicos.dataAtual );
            dispatch('SET_MODO_EDICAO' );
            dispatch('EXIBIR_MODAL_ATENDIMENTO');

        },

        ATENDIMENTO: function({ commit, state, dispatch}, atendimento){

            var atendimento = JSON.parse( JSON.stringify( atendimento ) );

            dispatch('RESET_ATENDIMENTO');
            dispatch('SET_STATUS_ATENDIMENTO', atendimento );
            dispatch('SET_PROFISSIONAL_ATENDIMENTO', atendimento.id_profissional );
            dispatch('SET_HORARIOS_ATENDIMENTO', atendimento );
            dispatch('SET_DATA_ATENDIMENTO', atendimento );
            dispatch('SET_ESPECIALIDADE_ATENDIMENTO', atendimento );
            dispatch('SET_CLINICA_ATENDIMENTO', atendimento );
            dispatch('SET_ID_ATENDIMENTO', atendimento );

            if( atendimento.usuario_agendante_id ){
                dispatch('SET_AGENDANTE_ATENDIMENTO', atendimento );
                dispatch('RESET_MODO_EDICAO' );
            }else{

                if(atendimento.nome && atendimento.telefone){
                    commit('SET_PRE_CADASTRO', atendimento);
                }

                dispatch('SET_STATUS_ATENDIMENTO_AGENDADO');
                dispatch('SET_MODO_EDICAO' );
            }

            dispatch('EXIBIR_MODAL_ATENDIMENTO');
        },

        // DETALHE_ATENDIMENTO: function({ commit, state, dispatch}, payload){

        //     log('DETALHE_ATENDIMENTO');

        //     dispatch('RESET_ATENDIMENTO');

        //     var profissional = payload.profissional;
        //     var item = JSON.parse( JSON.stringify( payload.item ) );

        //     dispatch('SET_STATUS_ATENDIMENTO', item.atendimento );
        //     dispatch('SET_PROFISSIONAL_ATENDIMENTO', profissional.id_profissional );
        //     dispatch('SET_HORARIOS_ATENDIMENTO', item );

        //     if(item.atendimento){

        //         dispatch('SET_DATA_ATENDIMENTO', item.atendimento );
        //         dispatch('SET_ESPECIALIDADE_ATENDIMENTO', item.atendimento );
        //         dispatch('SET_CLINICA_ATENDIMENTO', item.atendimento );
        //         dispatch('SET_ID_ATENDIMENTO', item.atendimento );

        //         if( item.atendimento.usuario_agendante_id ){
        //             dispatch('SET_AGENDANTE_ATENDIMENTO', item.atendimento );
        //         }else{
        //             dispatch('SET_STATUS_ATENDIMENTO_AGENDADO');
        //         }

        //     }else{

        //         dispatch('SET_DATA_ATENDIMENTO', state.dadosBasicos.dataAtual );
        //     }

        // },

// --------------------------------------------------------------------
// STATUS ATENDIMENTO
// --------------------------------------------------------------------
        SAVE_STATUS_ATENDIMENTO: function({ commit, state, dispatch }, status){

            log('SAVE_STATUS_ATENDIMENTO')

            // commit('SET_STATUS_ATENDIMENTO', status);
            dispatch('SET_STATUS_ATENDIMENTO_BY_ID_STATUS', status.id_status_atendimento);

            var dados = {
                id_status_atendimento: state.atendimento.id_status_atendimento,
                id_atendimento: state.atendimento.id_atendimento,
            }

            var request = serviceAtendimento.alterarStatus(dados);

            request.done(function(result){
                commit('REPLACE_ATENDIMENTO', result.data.atendimento);
                commit('SET_ID_ATENDIMENTO', result.data.atendimento);
                dispatch('ATUALIZAR_GRADE');
            });

        },

        SAVE_STATUS_ATENDIMENTO_ATENDENDO: function( { dispatch, commit, state}, atendimento ){
            dispatch('SET_ID_ATENDIMENTO', atendimento);
            dispatch('SAVE_STATUS_ATENDIMENTO', {id_status_atendimento: 5});
        },

        SAVE_STATUS_ATENDIMENTO_ATENDIDO: function( { dispatch, commit, state}, atendimento ){
            dispatch('SET_ID_ATENDIMENTO', atendimento);
            dispatch('SAVE_STATUS_ATENDIMENTO', {id_status_atendimento: 6});
        },

        SAVE_STATUS_ATENDIMENTO_SELECIONADO_CANCELADO: function( { dispatch, commit, state} ){
            log('SAVE_STATUS_ATENDIMENTO_SELECIONADO_CANCELADO');
            dispatch('SAVE_STATUS_ATENDIMENTO',  {id_status_atendimento: 7});
        },
        // ------------------------------------------------------------------------------------------

        SET_STATUS_ATENDIMENTO: function( { commit, state}, payload ){
            log('SET_STATUS_ATENDIMENTO');
            commit('SET_STATUS_ATENDIMENTO', payload);
        },


        SET_STATUS_ATENDIMENTO_AGENDADO: function( { dispatch, commit, state} ){
            dispatch('SET_STATUS_ATENDIMENTO_BY_ID_STATUS', 2);
        },

        SET_STATUS_ATENDIMENTO_BY_ID_STATUS: function( { commit, state, dispatch}, idStatus ){

            log('SET_STATUS_ATENDIMENTO_BY_ID_STATUS')

            var statusAtendimento = JSON.parse( JSON.stringify( state.dadosBasicos.statusAtendimento ) )

            var status =_.find(statusAtendimento, function(o) {
                return o.id_status_atendimento == idStatus;
            });

            dispatch('SET_STATUS_ATENDIMENTO', status)
        },

        RESET_FILTRO_NOME: function({commit}){
            commit('RESET_FILTRO_NOME')
        },

        RESET_FILTRO_FILA_NOME: function({commit}){
            commit('RESET_FILTRO_FILA_NOME')
        },

        RESET_FILTRO_FILA_STATUS: function(state){
            commit('RESET_FILTRO_FILA_STATUS')
        },

        RESET_FILTRO_FILA_ESPECIALIDADE: function(state){
            commit('RESET_FILTRO_FILA_ESPECIALIDADE')
        },

// --------------------------------------------------------------------
// PROCESSAMENTO
// --------------------------------------------------------------------

        PROCESSAR_PROFISSIONAIS: function ({ commit, state}, payload) {

            log('PROCESSAR_PROFISSIONAIS');

            function filtrar(atendimento){

                var nome = atendimento.nm_agendante || atendimento.nome;

                if(state.filtroGrade.status.length > 0){
                    if( !(state.filtroGrade.status.indexOf( atendimento.id_status_atendimento) >= 0) ){
                        return false;
                    }
                }

                if(state.filtroGrade.especialidade){
                    if( state.filtroGrade.especialidade != atendimento.id_especialidade ){
                        return false;
                    }
                }

                if( state.filtroGrade.nm_agendante){

                    if( !nome ){
                        return false
                    }

                    nome = nome.toLowerCase();

                    if(  nome.indexOf( state.filtroGrade.nm_agendante.toLowerCase() ) < 0 ){
                        return false;
                    }
                }

                return true
            }

            var profissionais = JSON.parse(JSON.stringify( state.clinica.profissionaisClinica ));
            var atendimentos = JSON.parse(JSON.stringify( state.atendimentos ));
            var atendimentosFiltrados = []

            atendimentos.forEach(function(itemAtendimentoFiltrado, indexAtendimento){
                if(filtrar(itemAtendimentoFiltrado)){
                    console.log(itemAtendimentoFiltrado.nm_status_atendimento)
                    atendimentosFiltrados.push(itemAtendimentoFiltrado)
                }

            });

            profissionais.forEach( function(itemProfissional, indexProfissional){

                profissionais[indexProfissional].atendimentos = [];

                atendimentosFiltrados.forEach(function(itemAtendimento, indexAtendimento){

                    if(itemAtendimento.id_profissional == itemProfissional.id_profissional){

                        profissionais[indexProfissional].atendimentos.push(itemAtendimento);

                    }

                });

            });

            commit('SET_PROFISSIONAIS_CLINICA', profissionais);

        },

        COMPILAR_GRADE: function ({ commit, state}, payload) {
            log('COMPILAR_GRADE');

            var horariosClinica = JSON.parse(JSON.stringify( state.dadosBasicos.horarios ));
            var profissionais = JSON.parse(JSON.stringify( state.clinica.profissionaisClinica ));

            var intervalosGrade = gerarIntervalosGrade();

            var grade = adicionarHorariosParaIntervaloGrade( intervalosGrade, horariosClinica )
            var lista = montarGrade( intervalosGrade, profissionais, horariosClinica  );


            commit('SET_GRADE', grade);
        },


        COMPILAR_FILA: function({ commit, state}, payload){
            log('COMPILAR_FILA ------');

            var atendimentos = [];

            var fila = [];

            state.atendimentos.forEach(function(item){
                if( item.id_tipo_especialidade == state.fila.filtro.tipoEspecialidade ){
                    fila.push( item );
                }
            });

            fila.forEach(function(atendimento, index){


                function filtrar(atendimento){

                    var nome =  atendimento.nm_agendante || atendimento.nome;
                    nome = nome.toLowerCase();

                    if( !(state.fila.filtro.status.indexOf( atendimento.id_status_atendimento) >= 0) ){
                        return false;
                    }

                    if( state.fila.filtro.nm_agendante ){
                        if(  nome.indexOf( state.fila.filtro.nm_agendante.toLowerCase() ) < 0 ){
                            return false;
                        }
                    }

                    return true
                }

                var obj = padronizarObjetoAtendimento(atendimento)

                obj.profissional = {
                    id_profissional: atendimento.id_profissional,
                    nm_profissional: atendimento.nm_profissional
                }

                if( atendimento.nm_agendante ||  atendimento.nome  ){

                    if( filtrar( atendimento ) ){

                        if( state.fila.filtro.profissional == '' ){
                            atendimentos.push( obj );
                        }else{
                            if( state.fila.filtro.profissional == obj.profissional.id_profissional ){
                                atendimentos.push( obj );
                            }

                        }


                    }
                }

            });

            // Ordena
            atendimentos.sort(function (a, b) {
                return new Date(a.inicio) - new Date(b.inicio);
            });

            _.sortBy(atendimentos, [function(o) { return o.inicio; }]);

            commit('SET_ITENS_FILA', atendimentos);

        }

	},

	getters: {

        statusListaveis: function(state){

            var statusListaveis = [];
            var excluidos = ['1','7'];

            state.dadosBasicos.statusAtendimento.forEach(function(status){
                if(  excluidos.indexOf( status.id_status_atendimento) == -1 ){
                    statusListaveis.push( status )
                }
            })

            return statusListaveis
        },

        statusEdicaoAtendimento: function(state){

            var statusListaveis = [];
            var excluidos = ['1','5','6','7'];

            state.dadosBasicos.statusAtendimento.forEach(function(status){
                if(  excluidos.indexOf( status.id_status_atendimento) == -1 ){
                    statusListaveis.push( status )
                }
            })

            return statusListaveis
        }

    }
}

// ----------------------------------------------------------
// HEPLER
// ----------------------------------------------------------

function prepararAtendimentoParaSalvar({ commit, state}, payload){

    var dataAtual = state.atendimento.data;

    if( !state.atendimento.data ){
        var dataAtual = state.dadosBasicos.dataAtual;
    }

    dataAtual = dataAtual.split('/')
    dataAtual = dataAtual[2] + '-' + dataAtual[1] + '-' + dataAtual[0];

    var dados = {
        id_clinica:             state.clinica.idClinica,
        id_atendimento:         state.atendimento.id_atendimento,
        id_profissional:        state.atendimento.id_profissional,
        id_especialidade:       state.atendimento.id_especialidade,
        id_status_atendimento:  state.atendimento.id_status_atendimento,
        id_usuario_agendante:   state.atendimento.id_usuario_agendante,
        inicio_agendamento:     dataAtual + ' ' + state.atendimento.inicio,
        fim_agendamento:        dataAtual + ' ' + state.atendimento.fim,
        nome:                   state.atendimento.agendante.nm_usuario,
        telefone:               state.atendimento.agendante.celular,
    }

    return dados;
}
