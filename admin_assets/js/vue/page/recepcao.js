
var app = new Vue({

    store: storeRecepcao,


    el: '#recepcao',

    data: {
        modoEdicao: false,
        exibirFiltroFilaStatus: false,
        exibirFiltroFilaPaciente: false,
        exibirFiltroGrade: false,
        pesquisa: {
            date: '',
            mes: '',
            ano: '',
            id_especialidade: '',
            id_profissional: '',
            tituloResultado: '',
            status: []
        },
        exibirTabAtendimento: true,
        exibirTabPesquisa: false
    },

    mounted: function(){
        var self = this;
        //this.getDadosBasicos();

        this.$store.dispatch('FETCH_DADOS_BASICOS');
        document.addEventListener('keyup', this.shortCutOrcamento, false);
        $('body').addClass('sidebar-collapse')

    },

    computed: {

        width: function(){
            return this.profissionaisClinica.length * 200;
        },

        profissionaisEspecialidade: function(){

            if(!this.especialidadesClinica[this.pesquisa.indexEspecialidade]){
                return [];
            }

            var especialidade = this.especialidadesClinica[this.pesquisa.indexEspecialidade]
            var profissionais =  especialidade.profissionais;

            this.pesquisa.idEspecialidade = especialidade.id_especialidade;

            return profissionais;
        },

        // VUEX
        dados: function(){
            return this.$store.state.recepcao;
        },

        dadosBasicos: function(){
            return this.$store.state.recepcao.dadosBasicos;
        },

        clinica: function(){
            return this.$store.state.recepcao.clinica;
        },

        atendimento: function(){
            return this.$store.state.recepcao.atendimento;
        },

        atendimentos: function(){
            console.log( 'ATENDIMENTO MUDOU' )
            return this.$store.state.recepcao.atendimentos;
        },

        grade: function(){
            return this.$store.state.recepcao.grade;
        },

        filtroGrade: function(){
            return this.$store.state.recepcao.filtroGrade;
        },

        diasDoMesComConsulta: function(){
            return this.$store.state.recepcao.diasComConsulta;
        },

        fila: function(){
            return this.$store.state.recepcao.fila;
        },

        statusEdicaoAtendimento: function(){
            return this.$store.getters.statusEdicaoAtendimento
        },

        pesquisaAtendimento: function(){
            return this.$store.state.recepcao.pesquisaAtendimento
        },

        urlPerfilUsuario: function(){
            var id = this.$store.state.recepcao.pesquisaAtendimento.agendante.usuario.id_usuario
            return base_url + 'admin/Paciente/show/' +    id
        },

        atendimentosPesqusia: function(){
            return this.$store.getters.atendimentosPesquisa
        }

    },

    methods: {

        shortCutOrcamento: function(e) {

            //e.preventDefault();

            // procura por nome na grade
            if (e.shiftKey && e.keyCode == 70) { //shift + f
                this.toggleFiltroGrade();
            }

            // procura por nome na fila
            if (e.shiftKey && e.keyCode == 68) { //alt + f
                this.toggleFiltroFilaNomePaciente();
            }

        },

        // --------------------------------------------------
        toggleTab: function(){
            this.exibirTabAtendimento = !this.exibirTabAtendimento;
            this.exibirTabPesquisa = !this.exibirTabPesquisa;
        },

        atualizarGrade: function(){
            logProcesso('ATUALIZAR GRADE');
            this.$store.dispatch('PROCESSAR_PROFISSIONAIS')
            this.$store.dispatch('COMPILAR_GRADE')
        },

        novoAtendimento: function(){

            logProcesso(' NOVO EXIBIR_DETALHE_ATENDIMENTO');

            var atendimento = {
                fim_agendamento: moment( new Date() ).add( this.dadosBasicos.duracao ).format('YYYY-MM-DD HH:mm:ss') ,
                inicio_agendamento: moment( new Date() ).format('YYYY-MM-DD HH:mm:ss') ,
            }

            console.log(atendimento);

            this.$store.dispatch('ATENDIMENTO', atendimento);

            // this.$store.dispatch('DETALHE_ATENDIMENTO', payload);

            this.$store.dispatch('SET_TIPO_EDICAO', 'especialidade');

            this.exibirDetalheAtendimento();
            this.$store.dispatch('SET_STATUS_ATENDIMENTO_AGENDADO');
        },



        // FILTRO GRADE ------------------------------------------

        toggleFiltroGrade: function(){
            var self = this;
            this.resetFiltroGradePorNome();
            this.exibirFiltroGrade = !this.exibirFiltroGrade;

            setTimeout(function(){
                if( self.exibirFiltroGrade ){
                    document.getElementById('input-filtro-grade-nome-paciente').focus()
                }
            }, 400);
        },

        // FILTRO NOME
        filtrarGradePorNome: function(){
            this.$store.dispatch('PROCESSAR_PROFISSIONAIS');
            this.$store.dispatch('COMPILAR_GRADE');
        },

        resetFiltroGradePorNome: function(){
            console.log('RESET')
            this.$store.dispatch('RESET_FILTRO_FILA_NOME');
            this.$store.dispatch('PROCESSAR_PROFISSIONAIS');
            this.$store.dispatch('COMPILAR_GRADE');
        },

        // FILTRO STATUS
        filtroStatusGradeSelecionado: function(){
           var self = this;
            setTimeout(function(){
                self.$store.dispatch('PROCESSAR_PROFISSIONAIS');
                self.$store.dispatch('COMPILAR_GRADE');
            }, 250)
        },


        // FILTRO ESPECIALIDADE
        filtroEspecialidadeGradeSelecionado: function(){
            this.$store.dispatch('PROCESSAR_PROFISSIONAIS');
            this.$store.dispatch('COMPILAR_GRADE');
        },

        // FILTRO FILA ------------------------------------------

        // -- FILTRO NOME

        toggleFiltroFilaNomePaciente: function(){
            var self = this;
            this.resetFiltroFilaPorNome();
            this.exibirFiltroFilaPaciente = !this.exibirFiltroFilaPaciente;
            setTimeout(function(){
                if(self.exibirFiltroFilaPaciente){
                    document.getElementById('input-filtro-fila-nome-paciente').focus()
                }
            }, 400)
        },

        filtrarFilaPorNome: function(){
            this.$store.dispatch('COMPILAR_FILA');
        },

        resetFiltroFilaPorNome: function(){
            console.log('----------------');
            this.$store.dispatch('RESET_FILTRO_NOME');
            this.$store.dispatch('COMPILAR_FILA');
        },

        // -- FILTRO STATUS
        toggleDropDownStatus: function(){
            this.exibirFiltroFilaStatus = !this.exibirFiltroFilaStatus;
            // $('.dropdown-status').toggleClass('open')
        },

        // hideDropDownStatus: function(){
        //     logProcesso('HIDE DROPDOW STATUS');
        //     $('.dropdown-status').removeClass('open')
        // },

        setFiltroTipoEspecilidade: function(idTipoEspecialidade){
            logProcesso('SET FILTRO ESPECIALIDADE FILA');
            this.$store.dispatch('SET_TIPO_ESPECIALIDADE_FILA', idTipoEspecialidade)
            this.$store.dispatch('COMPILAR_FILA')
        },

        statusFilaSelecionado: function(){
            logProcesso('STATUS FILA SELECIONADO');
            var self = this;
            setTimeout(function(){
                console.log('Clicado')
                self.$store.dispatch('COMPILAR_FILA');
            }, 250)
        },


        setProfissionalFiltroFila: function(profissional){
            logProcesso('FILTRAR POR PROFISSIONAL');
            log('SETAR FILTRO POR PROFISSIONAL');
            this.fila.filtro.profissional = profissional.id_profissional;
            this.$store.dispatch('COMPILAR_FILA');
        },

        resetProfissionalFiltroFila: function(){
            logProcesso('RESET FILTRO POR PROFISSIONAL');
            log('RESET FILTRO');
            this.fila.filtro.profissional = '';
            this.$store.dispatch('COMPILAR_FILA');
        },


// -----------------------------------------------------------
// -----------------------------------------------------------
// -----------------------------------------------------------

        stringResultado: function(){

            var idEspecialidade = this.pesquisa.id_especialidade
            var idProfissional = this.pesquisa.id_profissional
            var strEspecialidade = '';
            var strProfissional = '';
            var strData = '';

            if(this.pesquisa.id_especialidade){

                especilidadeSelecionada = _.find(this.clinica.especialidadesClinica, function(o) {
                    return o.id_especialidade == idEspecialidade;
                });

                strEspecialidade += especilidadeSelecionada.nm_especialidade + ' - ';

            }

            if(this.pesquisa.id_profissional){

                profissionalSelecionado = _.find(this.clinica.profissionaisClinica, function(o) {
                    return o.id_profissional == idProfissional;
                });

                strEspecialidade += ' com ' + profissionalSelecionado.nm_profissional + ' - ';

            }

            if(this.pesquisa.date){
                strEspecialidade += ' no dia ' + moment(this.pesquisa.date).format('DD/MM');
            }

            this.pesquisa.tituloResultado = strEspecialidade;

        },

        diaSelecionado: function (dia) {
            logProcesso('DIA SELECIONADO');
            this.$store.dispatch('RESET_AGENDANTE_PESQUISA_ATENDIMENTO');

            var self = this;

            var dados = {
                data: dia.date,
                id_clinica: this.clinica.idClinica,
                id_especialidade: this.pesquisa.id_especialidade,
                id_profissional:  this.pesquisa.id_profissional,
                status: this.pesquisa.status
            }

            this.pesquisa.date = dia.date;

            this.stringResultado();
            this.$store.dispatch('FETCH_ATENDIMENTOS_DATA_SELECIONADA', dados);

        },

        mesSelecionado: function (date) {
            logProcesso('MES SELECIONADO');

            this.pesquisa.ano = date.year;
            this.pesquisa.mes = date.month;

            this.pesquisarConsultas();
        },

        especialidadeMedicoSelecionado: function(dados){

            logProcesso('ESPECIALIDADE/MEDICO SELECIONADO');

            this.pesquisa.tituloResultado = '';
            this.$store.dispatch('RESET_ATENDIMENTOS_DATA_SELECIONADA');
            this.$store.dispatch('RESET_AGENDANTE_PESQUISA_ATENDIMENTO');

            this.setDataPadraoPesquisa();

            this.pesquisa.id_especialidade = dados.especialidade.id_especialidade || '';
            this.pesquisa.id_profissional  = dados.profissional.id_profissional   || '';

            this.pesquisarConsultas();

        },

        usuarioPesquisaMedicoSelecionado: function(dados){

            logProcesso('ESPECIALIDADE/MEDICO SELECIONADO');

            this.pesquisa.tituloResultado = '';
            this.$store.dispatch('RESET_ATENDIMENTOS_DATA_SELECIONADA');
            this.setDataPadraoPesquisa();

            this.pesquisa.id_especialidade = dados.especialidade.id_especialidade || '';
            this.pesquisa.id_profissional  = dados.profissional.id_profissional   || '';

            this.pesquisarConsultas();

        },

        statusSelecionado: function(){
            logProcesso('STATUS PESQUISA SELECIONADO');
            this.$store.dispatch('RESET_ATENDIMENTOS_DATA_SELECIONADA');
            this.$store.dispatch('RESET_AGENDANTE_PESQUISA_ATENDIMENTO');
            this.setDataPadraoPesquisa();
            var self = this;
            setTimeout(function(){
                self.pesquisarConsultas();
            },250)

        },

        cancelar: function(){
            this.$store.dispatch('SAVE_STATUS_ATENDIMENTO_SELECIONADO_CANCELADO');
        },

        setDataPadraoPesquisa: function(){
            this.pesquisa.ano = moment( new Date).format('YYYY');
            this.pesquisa.mes = moment( new Date).format('MM/YYYY');
        },

        pesquisarConsultas: function(){

            logProcesso('PESQUISAR CONSULTAS DO MES');
            this.$store.dispatch('RESET_AGENDANTE_PESQUISA_ATENDIMENTO');
            var dados = {
                ano: this.pesquisa.ano,
                mes: this.pesquisa.mes,
                id_especialidade: this.pesquisa.id_especialidade,
                id_profissional: this.pesquisa.id_profissional,
                status: this.pesquisa.status
            }

            this.$store.dispatch('FETCH_DIAS_COM_CONSULTAS_MES', dados);

        },

        setUsuarioPesquisaConsulta: function(usuario){
            logProcesso('SET_AGENDANTE_PESQUISA_ATENDIMENTO');
            this.$store.dispatch('RESET_AGENDANTE_PESQUISA_ATENDIMENTO');
            this.$store.dispatch('RESET_ATENDIMENTOS_DATA_SELECIONADA');
            this.$store.dispatch('SET_AGENDANTE_PESQUISA_ATENDIMENTO', usuario);

            this.pesquisa.tituloResultado = 'Atendimentos do usuário';

            var dados = {
                id_clinica: this.clinica.idClinica
            }
            console.log(usuario)
            console.log(usuario.id_usuario)
            if(usuario.id_usuario){
                dados.id_usuario_agendante = usuario.id_usuario;
            }else{
                dados.id_atendimento = usuario.id_atendimento;
            }

            this.$store.dispatch('FETCH_ATENDIMENTOS_USUARIO', dados);

        },

        // ------------------------------------------------------------------------------------------

        alterarAtendimento: function(){
            logProcesso('UPDATE_ATENDIMENTO')
            this.$store.dispatch('UPDATE_ATENDIMENTO');
        },

        salvarAtendimento: function(){
            logProcesso('SAVE_ATENDIMENTO');
            this.$store.dispatch('SAVE_ATENDIMENTO');
        },

        setUsuarioAgendante: function(usuario){
            logProcesso('SET_AGENDANTE_ATENDIMENTO');
            this.$store.dispatch('SET_AGENDANTE_ATENDIMENTO', usuario);
        },

        _exibirDetalheAtendimento: function(item, profissional){
            logProcesso(' (FILA) EXIBIR_DETALHE_ATENDIMENTO');
            this.$store.dispatch('ATENDIMENTO', item.atendimento);
            this.$emit('atendimento-selecionado', item);
            this.$store.dispatch('SET_TIPO_EDICAO', 'profissional');
        },


        exibirDetalheAtendimento:function(){

        },


// --------------------------------------------------------------
// --------------------------------------------------------------
// --------------------------------------------------------------
//

        ocultarDetalheAtendimento: function(){
            this.$store.dispatch('OCULTAR_MODAL_ATENDIMENTO');
        },

        setModoEdicao: function(){
            this.$store.dispatch('SET_MODO_EDICAO');
        },

        resetModoEdicao: function(){
            this.$store.dispatch('RESET_MODO_EDICAO');
        },

    }

});


