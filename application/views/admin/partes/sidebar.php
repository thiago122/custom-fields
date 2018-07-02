<!-- Left side column. contains the sidebar -->

    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

            <!-- Sidebar user panel -->

            <div class="user-panel">

                <div class="pull-left image">
                    <img src="<?php echo $this->acesso->get_avatar_usuario(); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $this->acesso->get_nm_usuario() ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>

            </div><!-- /Sidebar user panel -->

            <ul class="sidebar-menu">


                <li class="header">MENU PRINCIPAL</li>
                    <li class="treeview">
                        <a href="<?php echo base_url('admin/painel') ?>">
                        <i class="fa fa-dashboard"></i> <span>Início</span>
                    </a>
                </li>

                <?php if($this->acesso->podeAcessar('listar-pacientes')): ?>
                <li>
                    <a href="<?php echo base_url('admin/Paciente') ?>">
                        <i class="fa fa-users"></i>
                        <span>Paciente</span>
                    </a>
                </li>
                <?php endif ?>

                <?php if( $this->acesso->podeAcessar('gerar-atendimentos') || $this->acesso->podeAcessar('gerenciar-recepcao')  ): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span>Atendimentos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <?php if( $this->acesso->podeAcessar('gerar-atendimentos') ): ?>
                        <li><a href="<?php echo base_url('admin/atendimento/Gerar/') ?>"><i class="fa fa-circle-o"></i> Gerar atendimentos</a></li>
                        <?php endif ?>

                        <?php if( $this->acesso->podeAcessar('gerenciar-recepcao')  ): ?>
                        <li><a href="<?php echo base_url('admin/atendimento/Recepcao/') ?>"><i class="fa fa-circle-o"></i> Recepção</a></li>
                        <?php endif ?>

                      
                        <li><a href="<?php echo base_url('admin/atendimento/Consulta/') ?>"><i class="fa fa-circle-o"></i> Médico</a></li>
                        
           


                    </ul>

                </li>
                <?php endif ?>

                <?php if($this->acesso->podeAcessar('listar-clinica')): ?>
                <li>
                    <a href="<?php echo base_url('admin/Clinica') ?>">
                        <i class="fa fa-university"></i>
                        <span>Clínicas</span>
                    </a>
                </li>
                <?php endif ?>

                <?php if($this->acesso->podeAcessar('listar-profissionais')): ?>
                <li>
                    <a href="<?php echo base_url('admin/Profissional') ?>">
                        <i class="fa  fa-user-md"></i>
                        <span>Profissional de saúde</span>
                    </a>
                </li>
                <?php endif ?>

                <?php if($this->acesso->podeAcessar('listar-especialidade')): ?>
                <li>
                    <a href="<?php echo base_url('admin/Especialidade') ?>">
                        <i class="fa fa-heartbeat"></i>
                        <span>Especialidade</span>
                    </a>
                </li>
                <?php endif ?>

                <?php if($this->acesso->podeAcessar('admin/usuario/index')): ?>

                <li>
                    <a href="<?php echo base_url('admin/usuario') ?>">
                        <i class="fa fa-user-plus"></i>
                        <span>Usuários</span>
                    </a>
                </li>
                <?php endif ?>

                <?php if($this->acesso->podeAcessar('admin/configuracao/index')): ?>
                <li>
                    <a href="<?php echo base_url('admin/configuracao') ?>">
                        <i class="fa fa-gears"></i>
                        <span>Configurações</span>
                    </a>
                </li>
                <?php endif ?>

                <?php if($this->acesso->is_super_admin()): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-lock"></i>
                        <span>Permissões</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/nivel') ?>"><i class="fa fa-circle-o"></i> Níveis</a></li>
                        <li><a href="<?php echo base_url('admin/recurso') ?>"><i class="fa fa-circle-o"></i> Recursos</a></li>
                        <li><a href="<?php echo base_url('admin/permissao') ?>"><i class="fa fa-circle-o"></i> Permissões</a></li>
                    </ul>
                </li>
                <?php endif ?>

            </ul>
        </section><!-- /sidebar -->
    </aside><!-- /Left side column. contains the sidebar -->

