<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Especialidade</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

		<?php echo form_open_multipart('admin/especialidade/update/'.$especialidade->id_especialidade . '/' . query_string('?')) ?>
        <div class="row">

            <div class="col-md-6">

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Alterar especialidade</h3>
                    </div><!-- /box-header -->

                    <div class="box-body form-horizontal">

						<div class="form-group">
                            <label class="col-lg-4 control-label">Nome<span class="text-red">*</span></label>
                            <div class="col-lg-8">
								<input class="form-control" type="text" name="nm_especialidade"  value="<?php echo set_value('nm_especialidade', $especialidade->nm_especialidade) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Tipo<span class="text-red">*</span></label>
                            <div class="col-lg-8">
                                <select name="tipo_especialidade_id" class="form-control">
                                    <option value=""> Tipo </option>
                                    <?php echo option_dropdown($tipeEspecialidade, array('id_tipo_especialidade','nm_tipo_especialidade'), set_value( 'id_tipo_especialidade', $especialidade->tipo_especialidade_id) ) ?>
                                </select>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-lg-4 control-label">Descrição</label>
                            <div class="col-lg-8">
								<textarea  class="form-control" name="descricao_especialidade" rows="4"><?php echo set_value('descricao_especialidade',  $especialidade->descricao_especialidade) ?></textarea>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-lg-4 control-label">Resumo</label>
                            <div class="col-lg-8">
								<textarea  class="form-control" name="resumo_especialidade" rows="4"><?php echo set_value('resumo_especialidade',  $especialidade->resumo_especialidade) ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Preparo</label>
                            <div class="col-lg-8">
                                <textarea  class="form-control" name="preparo" rows="4"><?php echo set_value('preparo',  $especialidade->preparo) ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label"></label>
                            <div class="col-lg-8">
                                <div class="checkbox">
                                    <label>
                                        <?php echo  booleanCheckbox('especialidade_ativo', 1, set_value('especialidade_ativo', $especialidade->especialidade_ativo)); ?> Ativo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label"></label>
                            <div class="col-lg-8">
                                <div class="checkbox">
                                    <label>
                                        <?php echo  booleanCheckbox('agendar_sem_profissional', 1, set_value('agendar_sem_profissional', $especialidade->agendar_sem_profissional)); ?> Agendar sem profissional
                                    </label>
                                </div>
                            </div>
                        </div>

					</div><!-- box-body -->

		            <div class="box-footer">
		                <a type="submit" href="<?php echo base_url('admin/especialidade') ?>" class="btn btn-default">Cancelar</a>
		                <input type="submit" class="btn btn-success pull-right" value="Salvar">
		            </div><!-- /box-footer -->

                </div><!-- box -->

            </div><!-- col -->

        </div><!-- /row -->

		<?php echo form_close() ?><!-- form -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>

