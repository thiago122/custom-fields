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

                <!-- form -->
                <?php echo form_open_multipart('admin/usuario/update_senha') ?>
                    <div class="box">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Alterar senha</h3>
                        </div><!-- /box-header -->
                        <!-- box-body -->
                        <div class="box-body form-horizontal">

							<input type="hidden" name="id" value="<?php echo $id ?>">

							<div class="form-group no-margin-left no-margin-right margin-bottom-20 border-bottom-1 padding-bottom-20 border-grey-100">
								<label class="col-lg-4 control-label">Senha</label>
								<div class="col-lg-5">
									<input class="form-control" type="password" name="senha"  value="<?php echo set_value('senha') ?>">
								</div>
							</div>

							<div class="form-group no-margin-left no-margin-right margin-bottom-20 border-bottom-1 padding-bottom-20 border-grey-100">
								<label class="col-lg-4 control-label">Digite novamente a senha</label>
								<div class="col-lg-5">
			                        <input class="form-control" type="password" name="conf_senha"  value="<?php echo set_value('confirm_senha') ?>">
								</div>
							</div>

						</div><!-- /box-body -->

                        <!-- box-footer -->
                        <div class="box-footer">
                            <a type="submit" href="<?php echo base_url('admin/usuario') ?>" class="btn btn-default">Cancelar</a>
                            <input type="submit" class="btn btn-success pull-right" value="Salvar">
                        </div><!-- /box-footer -->
                    </div>
                <?php echo form_close() ?><!-- form -->
            </div><!-- col -->
        </div><!-- /row -->

	<!-- //////////////////////////////////////  -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
