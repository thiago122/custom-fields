<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
        <h1>
            Níveis de acesso
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
                <?php echo form_open_multipart('admin/Nivel/create' .'/'. query_string('?')) ?>
                    <div class="box">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Adicionar nível</h3>
                        </div><!-- /box-header -->
                        <!-- box-body -->
                        <div class="box-body form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nível</label>
                                <div class="col-sm-8">
                                    <input name="nm_nivel"  value="<?php echo set_value('nm_nivel') ?>" class="form-control" placeholder="Nome do nível">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Url de redirecionamento</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="redirect_url"  value="<?php echo set_value('redirect_url') ?>"  placeholder="admin/Painel">
                                </div>
                            </div>

							<h3>Selecione os recursos do nível</h3>


								<?php
									$tt = '';
									$last_tt = '';
								 ?>

								<?php foreach($recurso as $rc): ?>

									<?php $tt = $rc->nm_permissao; ?>

									<?php if( $tt != $last_tt): ?>

										<div class="box-header with-border"  style="clear:both; padding-top: 30px;">
											<h3 class="box-title"><?php echo  $rc->nm_permissao  ?></h3>
						                </div>

									<?php endif; ?>

										<div class="checkbox" style="width: 30%; margin-left: 1%; float: left">
											<span class="btn btn-default btn-xs">
												<label>
													<?php echo checkbox( 'recurso[]', $rc->id_recurso, $this->input->post('recurso[]') ).' ' . $rc->nm_recurso ?><br>
												</label>
											</span>
										</div>

									<?php $last_tt = $rc->nm_permissao; ?>
								<?php endforeach; ?>


                        </div><!-- /box-body -->

                        <!-- box-footer -->
                        <div class="box-footer">
                            <a type="submit" href="<?php echo base_url('admin/nivel') ?>" class="btn btn-default">Cancelar</a>
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

