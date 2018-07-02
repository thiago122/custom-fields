<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Usuários</h1>
        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>
    </section>

    <section class="content">

    	<?php echo form_open_multipart('admin/usuario/Update/' .$usuario->id_usuario. query_string('?')) ?>

        	<?php echo $this->mensagem->exibirTodas() ?>


                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Alterar usuário</h3>
						<div class="box-tools pull-right">
							<a href="#" data-toggle="dropdown" aria-expanded="true"><i class="ion-gear-a color-white"></i></a>
							<ul class="dropdown-menu pull-right margin-right-10">

								<?php if($this->acesso->podeAcessar('admin/usuario/permissoesEspeciais')): ?>
								<!-- <li>
									<a href="<?php echo base_url('admin/usuario/permissoesEspeciais/'. $usuario->id_usuario) ?>"><i class="fa fa-unlock"></i> Permissões </a>
								</li> -->
								<?php endif ?>

								<?php if($this->acesso->podeAcessar('admin/usuario/update_senha')): ?>
								<li>
									<a href="<?php echo base_url('admin/usuario/update_senha/'.$usuario->id_usuario) ?>"><i class="fa fa-key"></i> Alterar senha </a>
								</li>
								<?php endif ?>

							</ul>
						</div>

                    </div><!-- /box-header -->
                    <div class="box-body form-horizontal">

<!-- /////////////////////////////////////////////////////////////////////////////// -->

				        <div class="row">
				            <div class="col-md-6">

				            </div><!-- /col-->

				            <div class="col-md-6">

				            </div><!-- /col-->
				       	</div>

				        <div class="row">
				            <div class="col-md-6">

								<input type="hidden" name="id"  value="<?php echo set_value('id',$usuario->id_usuario) ?>">

								<div class="form-group">
									<label class="col-lg-4 control-label">Nome<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="nm_usuario"  value="<?php echo set_value('nm_usuario', $usuario->nm_usuario) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Data de nascimento<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control vdate" type="text" name="dt_nascimento"  value="<?php echo set_value('dt_nascimento', dateToBrDate($usuario->dt_nascimento)) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Sexo<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<div class="checkbox">
											<label>
												<?php booleanRadio('sexo', 'f', $usuario->sexo) ?> Feminino
											</label>
										</div>
										<div class="checkbox">
											<label>
												<?php booleanRadio('sexo', 'm', $usuario->sexo) ?> Masculino
											</label>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Cor</label>
									<div class="col-lg-8">
										<select name="cor_id" class="form-control">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($cores, array('id_cor','nm_cor'), set_value( 'cor_id', $usuario->cor_id) ) ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Estado Civil</label>
									<div class="col-lg-8">
										<select name="estado_civil_id" class="form-control">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($estadosCivis, array('id_estado_civil','nm_estado_civil'), set_value( 'estado_civil_id', $usuario->estado_civil_id) ) ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">CPF<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control vcpf" type="text" name="cpf"  value="<?php echo set_value('cpf', $usuario->cpf) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">RG</label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="rg"  value="<?php echo set_value('rg', $usuario->rg) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Emissor - RG</label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="emissor_rg"  value="<?php echo set_value('emissor_rg', $usuario->emissor_rg) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Estado - RG</label>
									<div class="col-lg-8">
										<select name="emissor_rg_estado" class="form-control">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'emissor_rg_estado', $usuario->emissor_rg_estado ) ) ?>
										</select>
									</div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-lg-4 control-label">Nacionalidade<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<div class="checkbox">
											<label>
												<?php booleanRadio('nacionalidade', 'b', $usuario->nacionalidade) ?> Brasileiro
											</label>
										</div>
										<div class="checkbox">
											<label>
												<?php booleanRadio('nacionalidade', 'e', $usuario->nacionalidade) ?> Estrangeiro
											</label>
										</div>
									</div>
								</div>


								<div class="form-group">
									<label class="col-lg-4 control-label">Naturalidade</label>
									<div class="col-lg-8">
										<select name="naturalidade_estado_id" class="form-control naturalidade">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'naturalidade_estado_id', $municipio_naturalidade->estado_id ) ) ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Cidade</label>
									<div class="col-lg-8">
										<select name="naturalidade_municipio_id" class="form-control cidade_naturalidade">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($municipios_naturalidade, array('id_municipio','nm_municipio'), set_value( 'naturalidade_municipio_id', $municipio_naturalidade->id_municipio) ) ?>
										</select>
									</div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-lg-4 control-label">Nível de acesso<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<select name="fk_nivel" class="form-control">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($niveis, array('id_nivel','nm_nivel'), set_value( 'fk_nivel', $usuario->fk_nivel) ) ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Ativo</label>
									<div class="col-lg-8">
										<div class="checkbox">
											<label>
												<?php echo  booleanCheckbox('usuario_ativo', 1, set_value('usuario_ativo', $usuario->usuario_ativo)); ?>Ativo
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
										<?php if( ! empty( $usuario->foto ) ): ?>
									    	<img class="img-responsive" src="<?php echo base_url() ?>arquivo/usuario/media_<?php echo $usuario->foto ?>">
										<?php else: ?>
											<img class="img-responsive" style="display: block; width:100%" src="<?php echo base_url() ?>admin_assets/img/perfil-default.png">
										<?php endif; ?>

									</div>
								</div>

				            </div><!-- /col-->

				            <div class="col-md-6">

								<div class="form-group">
									<label class="col-lg-4 control-label">Celular<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control vtel" type="text" name="celular"  value="<?php echo set_value('celular', $usuario->celular) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Fixo</label>
									<div class="col-lg-8">
										<input class="form-control vtel" type="text" name="fixo"  value="<?php echo set_value('fixo', $usuario->fixo) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">E-mail</label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="email"  value="<?php echo set_value('email',  $usuario->email) ?>">
									</div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-lg-4 control-label">CEP<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control vcep" type="text" name="cep"  value="<?php echo set_value('cep', $usuario->cep) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Estado<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<select name="estado_id" class="form-control estado">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($estados, array('id_estado','nm_estado'), set_value( 'estado_id', $usuario->estado_id) ) ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Cidade<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<select name="municipio_id" class="form-control cidade_endereco">
											<option value=""> Escolha </option>
											<?php echo option_dropdown($municipios_endereco, array('id_municipio','nm_municipio'), set_value( 'municipio_id', $usuario->municipio_id) ) ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Bairro<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control bairro_endereco" type="text" name="bairro"  value="<?php echo set_value('bairro', $usuario->bairro) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Logradouro<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="logradouro"  value="<?php echo set_value('logradouro', $usuario->logradouro) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Número<span class="text-red">*</span></label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="numero"  value="<?php echo set_value('numero', $usuario->numero) ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Complemento</label>
									<div class="col-lg-8">
										<input class="form-control" type="text" name="complemento"  value="<?php echo set_value('complemento', $usuario->complemento) ?>">
									</div>
								</div>


				            </div><!-- /col-->
				       	</div><!-- row -->

<!-- /////////////////////////////////////////////////////////////////////////////// -->

					</div><!-- /box-body -->
                    <div class="box-footer">
                        <a type="submit" href="<?php echo base_url('admin/usuario') ?>" class="btn btn-default">Cancelar</a>
                        <input type="submit" class="btn btn-success pull-right" value="Salvar">
                    </div><!-- /box-footer -->
                </div><!-- /box -->


		<?php echo form_close() ?><!-- form -->
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
