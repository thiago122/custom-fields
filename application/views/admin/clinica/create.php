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

        <?php echo form_open_multipart('admin/Clinica/store/' . query_string('?')) ?>

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Alterar clínica</h3>
                    </div><!-- /box-header -->

                    <div class="box-body form-horizontal">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Nome</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="nm_clinica"  value="<?php echo set_value('nm_clinica') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Descrição</label>
                                    <div class="col-lg-8">
                                        <textarea  class="form-control" name="descricao_clinica" rows="6"><?php echo set_value('descricao_clinica') ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Horário de funcionamento</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="horario_funcionamento"  value="<?php echo set_value('horario_funcionamento') ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo  booleanCheckbox('clinica_ativo', 1, set_value('clinica_ativo')); ?> Ativo
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">

                                        <div class="form-group">
                                            <label>Imagem de capa</label>
                                            <input class="form-control" type="file" name="img_capa" />

                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">

                                        <div class="form-group">
                                            <label>Imagem de destacada</label>
                                            <input class="form-control" type="file" name="img_thumb" />

                                        </div>

                                    </div>
                                </div>

                            </div><!-- col -->

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">CEP</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="cep"  value="<?php echo set_value('cep') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Estado<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="estado_id" class="form-control estado">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'estado_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Cidade<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="municipio_id" class="form-control cidade_endereco">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($municipios, array('id_municipio','nm_municipio'), set_value( 'municipio_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Bairro</label>
                                    <div class="col-lg-8">
                                        <input class="form-control bairro_endereco" type="text" name="bairro"  value="<?php echo set_value('bairro') ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Logradouro</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="logradouro"  value="<?php echo set_value('logradouro') ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Número</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="numero"  value="<?php echo set_value('numero') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Complemento</label>
                                    <div class="col-lg-8">
                                        <textarea  class="form-control" name="complemento" rows="6"><?php echo set_value('complemento') ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Como chegar</label>
                                    <div class="col-lg-8">
                                        <textarea  class="form-control" name="como_chegar" rows="6"><?php echo set_value('como_chegar') ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Link Rota</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="link_rota"  value="<?php echo set_value('link_rota') ?>">
                                    </div>
                                </div>


                            </div>

                        </div><!-- /row -->

                    </div><!-- box-body -->

                    <div class="box-footer">
                        <a type="submit" href="<?php echo base_url('admin/clinica') ?>" class="btn btn-default">Cancelar</a>
                        <input type="submit" class="btn btn-success pull-right" value="Salvar">
                    </div><!-- /box-footer -->

                </div><!-- box -->


        <?php echo form_close() ?><!-- form -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>

