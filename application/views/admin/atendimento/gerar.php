<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Gerar atendimento futuros</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

        <div class="row">

            <div class="col-md-6">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados básicos</h3>
                    </div>


                    <div class="box-body form-horizontal">

						<?php echo form_open_multipart('admin/atendimento/Gerar/store' . query_string('?')) ?>

							<div class="alert alert-info">Caso não seja especificada a data, serão gerados os atendimentos para a data <?php echo dateToBrDate(date('Y-m-d', strtotime( date('Y-m-d') . ' + '. INTERVALO_GERACAO_ATENDIMENTOS .' days'))); ?> </div>


							<div class="form-group">
                                <label class="col-sm-4 control-label">Data</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="dia" class="form-control vdate datepicker" autocomplete="off">
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
								<label class="col-lg-4 control-label">Clinica</label>
								<div class="col-lg-8">
									<select name="clinica_id" class="form-control">
										<option value=""> Escolha </option>
										<?php echo option_dropdown($clinicas, array('id_clinica','nm_clinica'), set_value( 'clinica_id') ) ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-4 control-label">Profissional</label>
								<div class="col-lg-8">
									<select name="profissional_id" class="form-control">
										<option value=""> Escolha </option>
										<?php echo option_dropdown($profissionais, array('id_profissional','nm_usuario'), set_value( 'profissional_id') ) ?>
									</select>
								</div>
							</div>

<!-- 							<div class="form-group">
								<label class="col-lg-4 control-label">Especialidade</label>
								<div class="col-lg-8">
									<select name="especialidade_id" class="form-control">
										<option value=""> Escolha </option>
										<?php echo option_dropdown($especialidades, array('id_especialidade','nm_especialidade'), set_value( 'especialidade_id') ) ?>
									</select>
								</div>
							</div> -->

							<div class="pull-right">
								<button class="btn btn-primary">Gerar Atendimentos futuros</button>
							</div>

						<?php echo form_close() ?><!-- form -->

                    </div>
                </div><!--/box endereço-->
            </div><!-- /col-md-4 -->





        </div>

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>

