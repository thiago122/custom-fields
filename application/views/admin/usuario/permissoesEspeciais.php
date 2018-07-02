<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
        <h1>
           Usuários
        </h1>
        <ol class="breadcrumb">
            <?php echo $this->breadcrumbs->exibe() ?>
        </ol>
    </section>
    <!-- page header -->

    <!-- Main content -->
    <section class="content">

        <!-- ////////////////////////////////////////////////// -->
        <div class="row">
            <div class="col-md-6">

                <?php echo $this->mensagem->exibirTodas() ?>

                    <div class="box">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Permissões do usuário: <b><?php echo $usuario->nm_usuario ?></b> </h3>
                        </div><!-- /box-header -->
                        <!-- box-body -->
                        <div class="box-body form-horizontal">
<!-- /////////////////////\\\\\\\\\\\\\\\\\\\\\\ -->

                            <?php
                                $tt = '';
                                $last_tt = '';
                            ?>

                            <?php foreach($recursos as $rc): ?>

                                <?php $tt = $rc->nm_permissao; ?>

                                <?php if( $tt != $last_tt): ?>
                                    <div class="separador-recursos" style="clear: both; margin: 20px 0  5px 0;">
                                        <?php echo  $rc->nm_permissao  ?>
                                    </div>
                                <?php endif; ?>

                                    <?php $classPertenceAoNivel = ($rc->existe == 1)? ' btn-success ' : 'btn-default' ; ?>

                                    <a href="<?php echo base_url('admin/usuario/permissoesEspeciais/'.$usuario->id_usuario.'/'.$rc->id_recurso); ?>" class="btn btn-sm <?php echo $classPertenceAoNivel ?> sys-toggle-recursos"> <?php echo $rc->nm_recurso ?></a>

                                <?php $last_tt = $rc->nm_permissao; ?>
                            <?php endforeach; ?>


<!-- /////////////////////\\\\\\\\\\\\\\\\\\\\\\ -->


                        </div><!-- /box-body -->
                    </div>
                <?php echo form_close() ?><!-- form -->
            </div><!-- col -->
        </div><!-- /row -->

    <!-- //////////////////////////////////////  -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>
