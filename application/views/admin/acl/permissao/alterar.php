<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
        <h1>
            Permissões do sistema
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
				<?php echo form_open_multipart('admin/Permissao/update' .'/'. query_string('?')) ?>
                    <div class="box">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Alterar permissão</h3>
                        </div><!-- /box-header -->
                        <!-- box-body -->
                        <div class="box-body form-horizontal">

							<input type="hidden" name="id"  value="<?php echo set_value('id',$permissao->id_permissao) ?>">
							<div class="form-group">
								<label class="col-lg-4 control-label">Permissão</label>
								<div class="col-lg-8">
									<input class="form-control" type="text" name="nm_permissao"  value="<?php echo set_value('nm_permissao', $permissao->nm_permissao) ?>">
								</div>
							</div>

                        </div><!-- /box-body -->

                        <!-- box-footer -->
                        <div class="box-footer">
                            <a type="submit" href="<?php echo base_url('admin/Permissao') ?>" class="btn btn-default">Cancelar</a>
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
