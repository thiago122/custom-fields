<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Profissionais de saúde</h1>
        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>
    </section>

    <section class="content">

        <?php echo form_open_multipart('admin/Profissional/store/'. query_string('?')) ?>

                <?php echo $this->mensagem->exibirTodas() ?>

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Adicionar profissional de saúde</h3>
                    </div><!-- /box-header -->
                    <div class="box-body form-horizontal">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Nome <span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="nm_usuario"  value="<?php echo set_value('nm_usuario') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Data de nascimento </label>
                                    <div class="col-lg-8">
                                        <input class="form-control vdate" type="text" name="dt_nascimento"  value="<?php echo set_value('dt_nascimento') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Sexo </label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label>
                                                <?php booleanRadio('sexo', 'f', $this->input->post('sexo')) ?> Feminino
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <?php booleanRadio('sexo', 'm', $this->input->post('sexo')) ?> Masculino
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Cor</label>
                                    <div class="col-lg-8">
                                        <select name="cor_id" class="form-control">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($cores, array('id_cor','nm_cor'), set_value( 'cor_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Estado Civil</label>
                                    <div class="col-lg-8">
                                        <select name="estado_civil_id" class="form-control">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($estadosCivis, array('id_estado_civil','nm_estado_civil'), set_value( 'estado_civil_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">CPF</label>
                                    <div class="col-lg-8">
                                        <input class="form-control vcpf" type="text" name="cpf"  value="<?php echo set_value('cpf') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">RG</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="rg"  value="<?php echo set_value('rg') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Emissor - RG</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="emissor_rg"  value="<?php echo set_value('emissor_rg') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Estado - RG</label>
                                    <div class="col-lg-8">
                                        <select name="emissor_rg_estado" class="form-control">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'emissor_rg_estado' ) ) ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Nacionalidade</label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label>
                                                <?php booleanRadio('nacionalidade', 'b', $this->input->post('nacionalidade')) ?> Brasileiro
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <?php booleanRadio('nacionalidade', 'e', $this->input->post('nacionalidade')) ?> Estrangeiro
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Naturalidade</label>
                                    <div class="col-lg-8">
                                        <select name="naturalidade_estado_id" class="form-control naturalidade">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'naturalidade_estado_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Cidade</label>
                                    <div class="col-lg-8">
                                        <select name="naturalidade_municipio_id" class="form-control cidade_naturalidade">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($municipios_naturalidade, array('id_municipio','nm_municipio'), set_value( 'naturalidade_municipio_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Ativo</label>
                                    <div class="col-lg-8">
                                        <div class="checkbox">
                                            <label>
                                                <?php $defaultAtivo = ( set_value('usuario_ativo') ? set_value('usuario_ativo') : 1 ) ?>
                                                <?php echo  booleanCheckbox('usuario_ativo', 1, $defaultAtivo); ?>Ativo
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Imagem de perfil</label>
                                    <div class=" col-xs-6 col-md-6">
                                        <input class="form-control" type="file" name="foto" />
                                    </div>
                                    <div class="col-xs-2 col-md-2">
                                        <img class="img-responsive" style="display: block; width:100%" src="<?php echo base_url() ?>admin_assets/img/perfil-default.png">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Senha<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="senha" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Redigite a senha<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="redigite_senha" value="">
                                    </div>
                                </div>

                            </div><!-- /col-->

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Celular<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control vtel" type="text" name="celular"  value="<?php echo set_value('celular') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Fixo</label>
                                    <div class="col-lg-8">
                                        <input class="form-control vtel" type="text" name="fixo"  value="<?php echo set_value('fixo') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">E-mail<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="email"  value="<?php echo set_value('email') ?>">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">CEP </label>
                                    <div class="col-lg-8">
                                        <input class="form-control vcep" type="text" name="cep"  value="<?php echo set_value('cep') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Estado </label>
                                    <div class="col-lg-8">
                                        <select name="estado_id" class="form-control estado">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'estado_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Cidade </label>
                                    <div class="col-lg-8">
                                        <select name="municipio_id" class="form-control cidade_endereco">
                                            <option value=""> Escolha </option>
                                            <?php echo option_dropdown($municipios_endereco, array('id_municipio','nm_municipio'), set_value( 'municipio_id') ) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Bairro </label>
                                    <div class="col-lg-8">
                                        <input class="form-control bairro_endereco" type="text" name="bairro"  value="<?php echo set_value('bairro') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Logradouro </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="logradouro"  value="<?php echo set_value('logradouro') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Número </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="numero"  value="<?php echo set_value('numero') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Complemento</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="complemento"  value="<?php echo set_value('complemento') ?>">
                                    </div>
                                </div>

                            </div><!-- /col-->

                            <div class="col-md-6">

                                <hr>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">CRM<span class="text-red">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="crm"  value="<?php echo set_value('crm') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Faculdade </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="faculdade"  value="<?php echo set_value('faculdade') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Residência médica </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="residencia"  value="<?php echo set_value('residencia') ?>">
                                    </div>
                                </div>

                                <hr>

                            </div><!-- /col-->


                        </div><!-- row -->

<!-- /////////////////////////////////////////////////////////////////////////////// -->

                    </div><!-- /box-body -->
                    <div class="box-footer">
                        <a type="submit" href="<?php echo base_url('admin/Profissional') ?>" class="btn btn-default">Cancelar</a>
                        <input type="submit" class="btn btn-success pull-right" value="Salvar">
                    </div><!-- /box-footer -->
                </div><!-- /box -->


        <?php echo form_close() ?><!-- form -->
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
