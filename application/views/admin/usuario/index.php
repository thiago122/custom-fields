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

		<!-- //////////////////////////////////////// -->

		<?php echo $this->mensagem->exibirTodas() ?>

		<div class="box">

		    <div class="box-header with-border">
		        <div class="row">

		            <div class="col-md-9">
		                <h3 class="box-title">Usuários (<?php echo $total; ?>)  </h3>
		            </div>

		            <div class="col-md-3">
		                <a href="<?php echo base_url('admin/usuario/create' .'/'. query_string('?')) ?>" class="btn btn-success btn-sm pull-right">
		                    <i class="fa fa-plus"></i>
		                Adicionar</a>
		            </div>

		        </div>
		    </div>
		    <div class="box-body">

				<form action="<?php echo base_url('admin/usuario') ?>" method="get">
				    <div class="panel panel-default">
				        <div class="panel-heading">Pesquisar</div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-md-3">
				                    <div class="form-group">
				                        <label>Usuário</label>
				                        <input class="form-control" type="text" name="nm_usuario" value="<?php echo $this->input->get('nm_usuario')?>" >
				                    </div>
				                </div>
				                <div class="col-md-3">
				                    <div class="form-group">
				                        <label>E-mail</label>
				                        <input class="form-control" type="text" name="email" value="<?php echo $this->input->get('email')?>" >
				                    </div>
				                </div>
				                <div class="col-md-3">
				                    <div class="form-group">
				                        <label>Nível</label>
				                        <select name="id_nivel" class="form-control">
				                            <option value="">Escolha</option>
				                            <?php  echo option_dropdown($nivel, array('id_nivel','nm_nivel'), $this->input->get('id_nivel') )  ?>
				                        </select>
				                    </div>
				                </div>
				            </div>

				            <div class="row">
				                <div class="col-md-12 text-right">
				                	<a class="btn btn-default" href="<?php echo base_url('admin/usuario') ?>">Limpar</a>
				                	&nbsp;
				                    <button class="btn btn-success" type="submit">
				                      <span class="glyphicon glyphicon-search"></span> Pesquisar
				                    </button>

				                </div>
				            </div>
				        </div>
				    </div>
				</form>

		        <table class="table table-bordered">
					<thead>
						<tr>
							<!-- <th class="vertical-middle" width="60">ID</th> -->
							<th class="vertical-middle">
								<a href="<?php echo base_url('admin/usuario') . orderQueryString('nm_usuario') ?>"><?php orderQueryStringBtn('nm_usuario') ?> Nome de usuário   </a>
							</th>
							<th class="vertical-middle">
								<a href="<?php echo base_url('admin/usuario') . orderQueryString('email') ?>">E-mail</a>
							</th>
							<th class="vertical-middle" width="80">
								Status
							</th>
							<th class="vertical-middle" width="150">
								<a href="<?php echo base_url('admin/usuario') . orderQueryString('nm_nivel') ?>">Nível</a>
							</th>
							<th class="vertical-middle"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $usuario as $usuario): ?>
						<tr>
							<!-- <td><?php echo  $usuario->id_usuario ?></td> -->
							<td>
								<a href="<?php echo base_url('admin/usuario/show/'.$usuario->id_usuario) ?>">
									<?php echo 	$usuario->nm_usuario ?>
								</a>
							</td>
							<td><?php echo 	$usuario->email ?></td>

							<td><?php echo  booleanText('Ativo', 'Inativo', $usuario->usuario_ativo) ?></td>
							<td><?php echo  $usuario->nm_nivel ?></td>
							<td width="80">
								<a href="<?php echo base_url('admin/usuario/edit/' . $usuario->id_usuario . '/' . query_string('?') )?>" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a>
								<a data-toggle="modal" data-target="#confirm-delete" data-href="<?php echo base_url('admin/usuario/delete/' . $usuario->id_usuario  . '/' . query_string('?') )?>" class="btn btn-danger btn-xs delete"><span class="fa fa-remove"></span></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
		    </div><!-- /.box-body -->

			<?php if($paginacao): ?>
		    <div class="box-footer clearfix">
		        <ul class="pagination pagination-sm no-margin pull-right">
					<?php echo $paginacao ?>
		        </ul>
		    </div>
		    <?php endif; ?>

		</div>

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

	<!-- //////////////////////////////////////  -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>
