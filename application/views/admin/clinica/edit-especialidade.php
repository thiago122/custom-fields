<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Clínicas</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

        <?php echo form_open_multipart('admin/Clinica/updateEspecialidade/'. $especialidade->clinica_id . '/' . $especialidade->especialidade_id . '/' . query_string('?')) ?>

                <input type="hidden" name="especialidade_id_old" value="<?php echo $especialidade->especialidade_id ?>">

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Alterar especialidade</h3>
                    </div><!-- /box-header -->

                    <div class="box-body form-horizontal">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Especialidade<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="especialidade_id" class="form-control">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($especialidades, array('id_especialidade','nm_especialidade'), set_value( 'especialidade_id', $especialidade->especialidade_id ) ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Valor<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control vmoney" type="text" name="valor"  value="<?php echo set_value('valor', decial_para_preco( $especialidade->valor ) ) ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Duração<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control vtime" type="text" name="duracao"  value="<?php echo set_value('duracao', $especialidade->duracao ) ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo  booleanCheckbox('agendar_online', 1, set_value('agendar_online', $especialidade->agendar_online)); ?> Permitir agendamento online
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo  booleanCheckbox('especialidade_clinica_ativo', 1, set_value('especialidade_clinica_ativo', $especialidade->especialidade_clinica_ativo )); ?> Ativo na clínica
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- col-md-6 -->

                        </div><!-- /row -->

                    </div><!-- box-body -->

                    <div class="box-footer">
                        <a type="submit" href="<?php echo base_url('admin/clinica') ?>" class="btn btn-default">Cancelar</a>

                        <a data-toggle="modal" data-target="#confirm-delete" data-href="<?php echo base_url('admin/Clinica/removeEspecialidade/'. $especialidade->clinica_id . '/' . $especialidade->especialidade_id . '/' . query_string('?') )?>" class="btn btn-danger delete">Excluir</a>


                        <input type="submit" class="btn btn-success pull-right" value="Salvar">
                    </div><!-- /box-footer -->

                </div><!-- box -->


        <?php echo form_close() ?><!-- form -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<!-- MODAL DELETE -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Excluir</a>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/partes/footer') ?>

