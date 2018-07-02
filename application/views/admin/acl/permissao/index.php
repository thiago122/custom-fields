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

		<!-- //////////////////////////////////////// -->

		<?php echo $this->mensagem->exibirTodas() ?>

		<div class="box">

		    <div class="box-header with-border">
		        <div class="row">
		            <div class="col-md-9">
		                <h3 class="box-title">Permissões do sistema (<?php echo $total; ?>)  </h3>
		            </div>
		            <div class="col-md-3">
		                <a href="<?php echo base_url('admin/Permissao/create' .'/'. query_string('?')) ?>" class="btn btn-success btn-sm pull-right">
		                    <i class="fa fa-plus"></i>
		                Adicionar</a>
		            </div>
		        </div>
		    </div>

		    <div class="box-body">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="80">Id </th>
							<th>Permissão</th>

							<th width="80"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $permissao_loop as $permissao): ?>
						<tr>
							<td><?php echo  $permissao->id_permissao ?></td>
							<td><?php echo  $permissao->nm_permissao ?></td>
							<td>
								<a href="<?php echo base_url('admin/Permissao/update/' .$permissao->id_permissao)?>" class="btn btn-primary btn-xs">
									<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a data-toggle="modal" data-target="#confirm-delete" data-href="<?php echo base_url('admin/Permissao/delete/'.$permissao->id_permissao) ?>" class="btn btn-danger btn-xs delete">
									<span class="fa fa-remove"></span>
								</a>
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

		</div><!-- /box  -->

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
