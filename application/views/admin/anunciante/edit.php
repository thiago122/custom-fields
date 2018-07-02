<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Anunciante</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

		<?php echo form_open_multipart('admin/anunciante/update/'.$anunciante->id_anunciante . '/' . query_string('?')) ?>
        <div class="row">

            <div class="col-md-4">

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Dados básicos</h3>
                    </div><!-- /box-header -->

                    <div class="box-body">

						<div class="form-group">
							<label >Nome</label>
							<input class="form-control" type="text" name="nm_anunciante"  value="<?php echo set_value('nm_anunciante', $anunciante->nm_anunciante) ?>">
						</div>

						<div class="form-group">
							<label>Descrição</label>
							<textarea  class="form-control" name="descricao" rows="6"><?php echo set_value('descricao',  $anunciante->descricao) ?></textarea>
						</div>

						<div class="form-group">
							<label>E-mail</label>
							<input class="form-control" type="text" name="email"  value="<?php echo set_value('email',  $anunciante->email) ?>">
						</div>

						<div class="form-group">
							<label>Telefone principal</label>
							<input class="form-control" type="text" name="telefone"  value="<?php echo set_value('telefone',  $anunciante->telefone) ?>">
						</div>

						<div class="form-group">
							<label>Telefone</label>
							<input class="form-control" type="text" name="telefone2"  value="<?php echo set_value('telefone2',  $anunciante->telefone2) ?>">
						</div>


						<div class="form-group">
							<label>Telefone</label>
							<input class="form-control" type="text" name="telefone3"  value="<?php echo set_value('telefone3',  $anunciante->telefone3) ?>">
						</div>

						<div class="form-group">
							<label>Whatsapp</label>
							<input class="form-control" type="text" name="whatsapp"  value="<?php echo set_value('whatsapp',  $anunciante->whatsapp) ?>">
						</div>

						<div class="form-group">
							<label>Site</label>
							<input class="form-control" type="text" name="site"  value="<?php echo set_value('site',  $anunciante->site) ?>">
						</div>

						<div class="form-group">
							<label>Facebook</label>
							<input class="form-control" type="text" name="facebook"  value="<?php echo set_value('facebook',  $anunciante->facebook) ?>">
						</div>

						<div class="form-group">
							<label>Instagram</label>
							<input class="form-control" type="text" name="instagram"  value="<?php echo set_value('instagram',  $anunciante->instagram) ?>">
						</div>

						<div class="form-group">
							<label>Twitter</label>
							<input class="form-control" type="text" name="twitter"  value="<?php echo set_value('twitter',  $anunciante->twitter) ?>">
						</div>

						<div class="form-group">
							<label>Faixa de preço</label>
							<input class="form-control" type="text" name="faixa_preco"  value="<?php echo set_value('faixa_preco',  $anunciante->faixa_preco) ?>">
						</div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                <?php echo  booleanCheckbox('anunciante_ativo', 1, set_value('anunciante_ativo', $anunciante->anunciante_ativo)); ?>Ativo
                                </label>
                            </div>
                        </div>

						<div class="form-group">
							<label>Imagem de perfil</label>
							<input class="form-control" type="file" name="img_perfil" />
							<?php if( ! empty( $anunciante->img_perfil ) ): ?>
						    	<img class="img-responsive" src="<?php echo base_url() ?>arquivo/anunciante/perfil_<?php echo $anunciante->img_perfil ?>">
							<?php else: ?>
								<img class="img-responsive" style="display: block; width:100%" src="<?php echo base_url() ?>admin_assets/admin/dist/img/perfil-default.png">
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label>Imagem de capa</label>
							<input class="form-control" type="file" name="img_capa" />
							<?php if( ! empty( $anunciante->img_capa ) ): ?>
						    	<img class="img-responsive" src="<?php echo base_url() ?>arquivo/anunciante/capa_<?php echo $anunciante->img_capa ?>">
							<?php else: ?>
								<img class="img-responsive" style="display: block; width:100%" src="<?php echo base_url() ?>admin_assets/admin/dist/img/perfil-default.png">
							<?php endif; ?>
						</div>

					</div>

                </div><!-- box -->

            </div><!-- col -->
            <div class="col-md-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Endereço</h3>
                    </div><!-- /box-header -->
                    <div class="box-body">

						<div class="form-group">
							<label>Estado</label>
							<select name="estado_id" class="form-control select-estado">
								<option value=""> Escolha </option>
								<?php echo option_dropdown($estado, array('id_estado','nm_estado'), set_value( 'estado_id', $anunciante->estado_id) ) ?>
							</select>
						</div>

						<div class="form-group">
							<label>Cidade</label>
							<select name="cidade_id" class="form-control select-cidade"  data-id="<?php echo $anunciante->cidade_id ?>">
								<option value=""> Escolha </option>
								<?php // echo option_dropdown($cidade, array('id_cidade','nm_cidade'), set_value( 'cidade_id', $anunciante->cidade_id) ) ?>
							</select>
						</div>

						<div class="form-group">
							<label>Bairro</label>
							<select name="bairro_id" class="form-control select-bairro" data-id="<?php echo $anunciante->bairro_id ?>">
								<option value=""> Escolha </option>
								<?php //echo option_dropdown($bairro, array('id_bairro','nm_bairro'), set_value( 'bairro_id', $anunciante->bairro_id) ) ?>
							</select>
						</div>

						<div class="form-group">
							<label>Cep</label>
							<input class="form-control input-cep" type="text" name="cep"  value="<?php echo set_value('cep',  $anunciante->cep) ?>">
						</div>

						<div class="form-group">
							<label>Rua</label>
							<input class="form-control logradouro" type="text" name="rua"  value="<?php echo set_value('rua',  $anunciante->rua) ?>">
						</div>

						<div class="form-group">
							<label>Número</label>
							<input class="form-control numero" type="text" name="numero"  value="<?php echo set_value('numero',  $anunciante->numero) ?>">
						</div>

						<div class="form-group">
							<label>Complemento</label>
							<input class="form-control v-cep" type="text" name="complemento"  value="<?php echo set_value('complemento',  $anunciante->complemento) ?>">
						</div>

						<div class="form-group">
							<label>Latitude</label>
							<input class="form-control campo_lat" type="text" name="latitude"  value="<?php echo set_value('latitude',  $anunciante->latitude) ?>">
						</div>

						<div class="form-group">
							<label>Longitude</label>
							<input class="form-control campo_long" type="text" name="longitude"  value="<?php echo set_value('longitude',  $anunciante->longitude) ?>">
						</div>

 					<!-- ///////// mapa ///////// -->
                        <script>
                        // var start_lat = '-22.89608192';
                        // var start_lng = '-43.12376404';
                        </script>

                        <span class="btn btn-block btn-info pesquisa-endereco ">clique aqui para pesquisar o endereço APROXIMADO no mapa</span>

                        <div id="map_canvas" class="mapa-editavel" style="width:100%; height:455px"></div>

                        <span class="btn btn-block btn-info pesquisa-endereco ">clique aqui para pesquisar o endereço APROXIMADO no mapa</span>


                    </div><!-- box-body -->
				</div>
			</div><!-- col -->

        </div><!-- /row -->

        <div class="box">
            <div class="box-body">

				<div class="form-group">
					<label>Formas de pagamento</label><br>
					<?php foreach($opcoesPagamento as $opcao_pagamento): ?>
	                    <div class="checkbox">
	                        <label>
								<input type="checkbox" name="opcao_pagamento[]" value="<?php echo $opcao_pagamento->id_opcao_pagamento ?>" <?php echo set_checkbox('opcao_pagamento[]', $opcao_pagamento->id_opcao_pagamento, $opcao_pagamento->ckecked ); ?>>
								<?php echo $opcao_pagamento->nm_opcao_pagamento ?>
	                        </label>
	                    </div>
					<?php endforeach ?>
				</div>

				<div class="form-group">
					<label>Categorias</label><br>
					<?php foreach($categorias as $cat_an_anunciante): ?>
	                    <div class="checkbox">
	                        <label>
								<input type="checkbox" name="cat_an_anunciante[]" value="<?php echo $cat_an_anunciante->id_cat_an ?>" <?php echo set_checkbox('cat_an_anunciante[]', $cat_an_anunciante->id_cat_an, $cat_an_anunciante->ckecked ); ?>>
								<?php echo $cat_an_anunciante->nm_cat_an ?>
	                        </label>
	                    </div>
					<?php endforeach ?>
				</div>

            </div><!-- /box-footer -->
        </div>




        <div class="box">
            <div class="box-footer">
                <a type="submit" href="<?php echo base_url('admin/usuario') ?>" class="btn btn-default">Cancelar</a>
                <input type="submit" class="btn btn-success pull-right" value="Salvar">
            </div><!-- /box-footer -->
        </div>

		<?php echo form_close() ?><!-- form -->



    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>

