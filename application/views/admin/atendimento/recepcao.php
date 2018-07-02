<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('admin_assets/css/ts-calendar.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('admin_assets/css/recepcao.css') ?>">

<div class="content-wrapper" id="recepcao">
    <loading></loading>
    <alert></alert>

    <section class="content-header">
        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>
    </section>



    <section class="content">

        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
                <config-recepcao class="pull-right" @clinica-selecionada="atualizarGrade"></config-recepcao>
            </div>
        </div>

        <div class="row" v-if="clinica.idClinica">

            <div class="col-md-3">
                <div class="sala-espera__profissionais">
                    <div class="form-group">
                        <button class="btn btn-block" @click="resetProfissionalFiltroFila" v-if="fila.filtro.profissional"> Todos </button>
                        <button class="btn btn-block btn-primary" @click="resetProfissionalFiltroFila" v-else> Todos </button>
                    </div>
                    <div class="sala-espera__profissional" v-for="profissional in clinica.profissionaisClinica" @click="setProfissionalFiltroFila(profissional)">

                        <img class="sala-espera__avatar-profissional selecionado" v-if="fila.filtro.profissional == profissional.id_profissional" :src="profissional.avatar.mini">
                        <img class="sala-espera__avatar-profissional" v-else  :src="profissional.avatar.mini">
                        {{profissional.nm_profissional}}
                    </div>
                </div><!-- /sala-espera__profissional -->

                <div class="sala-espera__fila">

                    <div class="box box-widget">

                        <div class="box-header with-border">
                            <h3 class="box-title">Fila</h3>

                            <button
                            type="button"
                            class="btn btn-xs btn-default btn-sm pull-right"
                            @click="toggleDropDownStatus">
                                Status <i class="fa fa-filter"></i>
                            </button>

                            <button
                                type="button"
                                class="btn btn-xs btn-default btn-sm pull-right"
                                style="margin-right: 10px"
                                @click="toggleFiltroFilaNomePaciente"
                            >
                                Paciente <i class="fa fa-search"></i>
                            </button>

                        </div>

                        <div class="box-body">

                            <div style="margin-bottom: 10px;" v-if="exibirFiltroFilaStatus">

                                <label
                                    @click="statusFilaSelecionado"
                                    class="filtro-fila-status"
                                    v-bind:class="status.class_css"
                                    v-for="status in dadosBasicos.statusAtendimento"
                                    v-if="status.nm_status_atendimento != 'Vago'"
                                >
                                    <input type="checkbox" :value="status.id_status_atendimento" v-model="fila.filtro.status">
                                    <span> {{status.nm_status_atendimento}} </span>
                                </label>
                            </div>

                            <div style="margin-bottom: 10px;" v-if="exibirFiltroFilaPaciente">

                                <div class="form-group">
                                    <input
                                    @input="filtrarFilaPorNome()"
                                    @keydown.esc="toggleFiltroFilaNomePaciente"
                                    class="form-control"
                                    type="text"
                                    placeholder="Digite o nome do Paciente"
                                    v-model="fila.filtro.nm_agendante"
                                    id="input-filtro-fila-nome-paciente"

                                    >
                                </div>
                            </div><!-- /filtro-paciente -->

                            <div class="form-group">
                                <div class="btn-group btn-group-justified" role="group">

                                    <div
                                        class="btn-group"
                                        role="group"
                                        v-for="tipoEspecialidade in dadosBasicos.tiposEspecialidade"
                                    >
                                        <button
                                            type="button"
                                            class="btn  btn-xs"
                                            :class="{'btn-success': tipoEspecialidade.id_tipo_especialidade == fila.filtro.tipoEspecialidade}"
                                            @click="setFiltroTipoEspecilidade(tipoEspecialidade.id_tipo_especialidade)"
                                        >
                                            {{tipoEspecialidade.nm_tipo_especialidade}}
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <!-- FILA ======================================================== -->
                            <item-fila
                                v-for="item in fila.itens"
                                v-if="item.atendimento.nm_agendante || item.atendimento.nome"
                                :atendimento="item.atendimento"
                                tipo="fila"
                                v-bind:exibir-botoes="true"
                                v-bind:exibir-especialidade="true"
                                v-bind:exibir-profissional="true"
                                v-bind:exibir-botoes="true"
                                v-bind:exibir-hora-inicial="true"
                                v-bind:exibir-hora-final="true"
                            >
                            </item-fila>
                           <!-- /FILA ======================================================== -->

                        </div><!-- /box-body -->
                    </div><!-- /box -->

                </div><!-- /sala-espera__fila -->

            </div><!-- /col-md-2 -->


            <div class="col-md-9">

                <div class="box box-widget">
                    <div class="box-header with-border">
                        <button
                            class="btn"
                            v-bind:class="{ 'btn-primary': exibirTabAtendimento, 'btn-default': !exibirTabAtendimento}" @click="toggleTab">
                            Atendimentos
                        </button>
                        <button
                            class="btn"
                            v-bind:class="{ 'btn-primary': exibirTabPesquisa, 'btn-default': !exibirTabPesquisa}" @click="toggleTab">
                            Pesquisa
                        </button>
                        <span
                            class="btn btn btn-success pull-right"
                            @click="novoAtendimento()"
                            v-if="clinica.especialidadesClinica.length"
                        >
                            Novo
                        </span>

                        <precos-atendimento label="Preços exames" tipo="2" class="pull-right" style="margin-right: 10px " v-if="clinica.especialidadesClinica.length > 0"> </precos-atendimento>

                        <precos-atendimento label="Preços Consulta" tipo="1" class="pull-right" style="margin-right: 10px " v-if="clinica.especialidadesClinica.length > 0"> </precos-atendimento>

                        <button
                            type="button"
                            class="btn btn-default pull-right"
                            style="margin-right: 10px"
                            @click="toggleFiltroGrade"
                        >
                            Filtrar grade <i class="fa fa-filter"></i>
                        </button>

                    </div><!-- /form-group -->

                    <div class="box-body">

                        <div v-if="exibirTabAtendimento">

                            <div
                            v-if="exibirFiltroGrade"
                            style="background-color: #f4f4f4; margin: -10px -10px 10px -10px; padding: 10px; border-bottom: 1px solid #ecf0f5;"
                            >

                                <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-3">
                                        <label>Paciente</label>
                                        <input
                                            @input="filtrarGradePorNome()"
                                            @blur="filtrarGradePorNome()"
                                            @keydown.esc="toggleFiltroGrade()"
                                            class="form-control input-sm"
                                            type="text"
                                            placeholder="Digite o nome do Paciente"
                                            v-model="filtroGrade.nm_agendante"
                                            id="input-filtro-grade-nome-paciente"
                                        >
                                    </div>

                                    <div class="col-md-3">

                                        <label>Especialidade</label>
                                        <select
                                            class="form-control input-sm"
                                            v-model="filtroGrade.especialidade"
                                            @change="filtroEspecialidadeGradeSelecionado()"
                                        >
                                            <option ></option>
                                            <option v-for="(especialidade, index) in clinica.especialidadesClinica" :value="especialidade.id_especialidade">
                                                {{ especialidade.nm_especialidade }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">

                                        <label
                                            @click="filtroStatusGradeSelecionado"
                                            class="filtro-fila-status"
                                            v-bind:class="status.class_css"
                                            style="width: 90px"
                                            v-for="status in dadosBasicos.statusAtendimento"
                                        >
                                            <input type="checkbox" :value="status.id_status_atendimento" v-model="filtroGrade.status">
                                            <span> {{status.nm_status_atendimento}} </span>

                                        </label>

                                    </div>

                                </div><!-- /row filtros -->
                            </div><!-- /filtros grade -->

                            <grade-recepcao @atendimento-selecionado="exibirDetalheAtendimento"></grade-recepcao>
                        </div><!-- /exibirTabAtendimento -->
                        <div v-if="exibirTabPesquisa">

                                <div class="row">
                                    <div class="col-md-3">
                                        <pesquisa-especialidade-medico @selecionado="especialidadeMedicoSelecionado" @alterado="especialidadeMedicoSelecionado">
                                        </pesquisa-especialidade-medico>

                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="padding: 3px 8px;">Filtrar por status</div>
                                            <div class="panel-body" style="padding: 3px 8px;">

                                                <div class="checkbox" v-for="status in dadosBasicos.statusAtendimento">
                                                    <label>
                                                        <input type="checkbox" :value="status.id_status_atendimento" v-model="pesquisa.status" @click="statusSelecionado">
                                                        {{status.nm_status_atendimento}}
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <ts-calendar
                                            v-bind:dias-mes="diasDoMesComConsulta"
                                            @day="diaSelecionado"
                                            @month="mesSelecionado"
                                        >
                                        </ts-calendar>

                                    </div>

                                    <div class="col-md-9">


                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="panel panel-default" v-if="pesquisaAtendimento.agendante.usuario.nm_usuario">
                                                    <div class="panel-body">

                                                        <div class="row" style="margin-bottom: 10px">
                                                            <div class="col-md-2">
                                                                <img
                                                                v-if="pesquisaAtendimento.agendante.usuario.avatar"
                                                                class="img-responsive img-circle"
                                                                :src="pesquisaAtendimento.agendante.usuario.avatar.mini"
                                                                >
                                                            </div><!-- /col-md-2 -->
                                                            <div class="col-md-5">
                                                                <div>
                                                                    <b>{{ pesquisaAtendimento.agendante.usuario.nm_usuario }}</b> <br>
                                                                </div>
                                                                <div v-if="pesquisaAtendimento.agendante.usuario.cpf">
                                                                    <b>CPF: </b> {{ pesquisaAtendimento.agendante.usuario.cpf }}<br>
                                                                </div>

                                                                <div v-if="pesquisaAtendimento.agendante.usuario.dt_nascimento">
                                                                    <b>Nascimento</b> {{ pesquisaAtendimento.agendante.usuario.dt_nascimento | date('DD/MM/YYYY') }}
                                                                </div>
                                                            </div><!-- /col-md-5 -->
                                                            <div class="col-md-5">
                                                                <div v-if="pesquisaAtendimento.agendante.usuario.celular">
                                                                    <b>Celular</b> {{ pesquisaAtendimento.agendante.usuario.celular }}<br>
                                                                </div>
                                                                <div v-if="pesquisaAtendimento.agendante.usuario.telefone">
                                                                    <b>Telefone</b> {{ pesquisaAtendimento.agendante.usuario.telefone }}<br>
                                                                </div>
                                                            </div><!-- /col-md-5 -->

                                                        </div><!-- row -->

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a :href="urlPerfilUsuario" target="_blank" class="btn btn-xs btn-success" v-if="pesquisaAtendimento.agendante.usuario.id_usuario">
                                                                    Ver Perfil
                                                                </a>

                                                            </div>

                                                        </div>

                                                    </div><!-- /panel-body -->
                                                </div><!-- /panel -->

                                            </div><!-- /col-md-8 -->
                                            <div class="col-md-4">
                                                <autocomplete
                                                    @object="setUsuarioPesquisaConsulta"
                                                    class="pull-right"
                                                    style="margin-bottom: 10px"
                                                    event-name="selectedUsuarioPesquisa"
                                                    placeholder="Pesquisar paciente"
                                                    key-object="id_usuario"
                                                    val-object="nm_usuario"
                                                    :reset-on-select="true"
                                                    :source="dados.urlBuscaAtendimentoUsuario"
                                                >
                                                </autocomplete>
                                            </div><!-- /col-md-4 -->
                                        </div>



                                        <div class="list-atendimentos-dia">
                                            <div class="list-atendimentos-dia__header">
                                                Resultados: <b style="color: #000">{{pesquisa.tituloResultado}}</b>
                                            </div>
                                            <div class="list-atendimentos-dia__body">

                                                <div
                                                    class="list-atendimentos-dia__item"
                                                >

                                                    <item-atendimento
                                                        v-for=" item in atendimentosPesqusia"
                                                        v-if="item.atendimento"
                                                        :atendimento="item.atendimento"
                                                        v-bind:exibir-especialidade="true"
                                                        v-bind:exibir-profissional="true"
                                                        v-bind:exibir-botoes="false"
                                                        v-bind:exibir-hora-inicial="true"
                                                        v-bind:exibir-hora-final="true"
                                                    >
                                                    </item-atendimento>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div><!-- /row -->
                        </div><!-- /exibirTabPesquisa -->

                    </div><!-- / -->
                </div><!-- /box -->


            </div><!-- /col-->

        </div><!-- /row -->

    </section><!-- /.content -->

    <!-- =================================== -->
    <!-- MODAL ATENDIMENTO ================= -->
    <!-- =================================== -->

    <div class="modal fade in" id="modal-atendimento">
      <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="ocultarDetalheAtendimento()">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atendimento</h4>
            </div>

            <div class="modal-body" >

                <preview-horario-atendimento    v-if="!atendimento.modoEdicao"></preview-horario-atendimento>
                <preview-profissional-atendimento   v-if="!atendimento.modoEdicao"></preview-profissional-atendimento>


                <div class="row" v-if="atendimento.modoEdicao && atendimento.id_status_atendimento < 5">
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            <label>Status inicial</label>
                            <select class="form-control input-sm"  v-model="atendimento.id_status_atendimento">
                                <option v-for="status in statusEdicaoAtendimento" :value="status.id_status_atendimento">
                                    {{ status.nm_status_atendimento }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <edit-profissional-atendimento v-if="atendimento.modoEdicao"></edit-profissional-atendimento>

                <edit-horario-atendimento v-if="atendimento.modoEdicao"></edit-horario-atendimento>

                <div class="clearfix" style="border-bottom: 1px solid #00a7d0; margin-bottom: 15px;" v-if="atendimento.modoEdicao">
                    <b style=" line-height: 34px; color: #0c96b8; font-size: 15px;">Paciente</b>
                    <autocomplete
                            @object="setUsuarioAgendante"

                            class="pull-right autocomplete-pacinete"
                            event-name="selectedResponsavel"
                            placeholder="Pesquisar"
                            key-object="id_usuario"
                            val-object="nm_usuario"
                            :reset-on-select="true"
                            :source="dados.urlBuscaUsuario">
                    </autocomplete>
                </div>

                <edit-pre-cadastro-paciente v-if="!atendimento.id_usuario_agendante && atendimento.modoEdicao"></edit-pre-cadastro-paciente>
                <preview-pre-cadastro-paciente v-if="!atendimento.id_usuario_agendante && !atendimento.modoEdicao"></preview-pre-cadastro-paciente>

                <preview-paciente-atendimento v-if="atendimento.id_usuario_agendante"></preview-paciente-atendimento>

            </div>

            <div class="modal-footer">
                <button v-if="atendimento.id_atendimento" class="btn btn-danger pull-left" v-on:click="cancelar">
                    <i class="fa fa-fw fa-trash-o"></i>
                </button>
                <button v-if="atendimento.id_atendimento" class="btn pull-left">
                    <i class="fa fa-fw fa-history"></i>
                </button>

                <button class="btn" @click="setModoEdicao()"    v-if="atendimento.modoEdicao == false"> Editar</button>
                <a class="btn" @click="resetModoEdicao()"  v-if="atendimento.modoEdicao == true && atendimento.id_atendimento"> Voltar</a>

                <button type="button" class="btn btn-primary"   v-if="atendimento.modoEdicao == true && atendimento.id_atendimento" v-on:click="alterarAtendimento()">Salvar</button>
                <button type="button" class="btn btn-primary"   v-if="atendimento.modoEdicao == true && !atendimento.id_atendimento" v-on:click="salvarAtendimento()">Salvar</button>
            </div>

        </div> <!-- /modal-content -->
      </div> <!-- /modal-dialog -->
    </div> <!-- /modal -->

    <!-- /MODAL ATENDIMENTO ================ -->

</div><!-- /.content-wrapper -->


<?php
    $scripts['scripts'] = [

        'lodash/lodash.min.js',
        'vue/helpers/helper-horarios.js',
        'vue/helpers/helper-alert.js',
        'vue/helpers/helper-log.js',
        'vue/services/services.js',
        'vue/vue.js',
        'vue/vuex2.3.js',
        'vue/store/modules/vuexRecepcao.js',
        'vue/store/vuex.js',

        'vue/directives/vue-outside-events.min.js',
        'vue/filters/filters.js',
        'vue/event-bus.js',
        'vue/dados.js',

        'vue/components/autocomplete/autocomplete.js',
        'vue/components/the-mask/vue-the-mask.js',
        'vue/components/loading/loading.js',
        'vue/components/alert/alert.js',
        'vue/components/ts-calendar/ts-calendar.js',

        'vue/components/app/recepcao/config/config-recepcao.js',
        'vue/components/app/recepcao/grade/grade.js',

        'vue/components/app/recepcao/status/status-atendimento.js',

        'vue/components/app/recepcao/item-atendimento/item-atendimento.js',
        'vue/components/app/recepcao/item-fila/item-fila.js',

        'vue/components/app/recepcao/precos/precos-atendimento.js',
        'vue/components/app/recepcao/profissional/edit-profissional-atendimento.js',
        'vue/components/app/recepcao/profissional/preview-profissional-atendimento.js',
        'vue/components/app/recepcao/horario/edit-horario-atendimento.js',
        'vue/components/app/recepcao/horario/preview-horario-atendimento.js',

        'vue/components/app/recepcao/paciente/edit-pre-cadastro-paciente.js',
        'vue/components/app/recepcao/paciente/preview-pre-cadastro-paciente.js',

        'vue/components/app/recepcao/paciente/preview-paciente-atendimento.js',

        'vue/components/app/recepcao/pesquisa/pesquisa-especialidade-medico.js',


        'vue/page/recepcao.js'
    ];
?>

<?php $this->load->view('admin/partes/footer', $scripts) ?>
