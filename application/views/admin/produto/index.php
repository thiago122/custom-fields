<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
        <h1>
            Produto
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
		                <h3 class="box-title">Anunciantes ()  </h3>
		            </div>

		            <div class="col-md-3">
		                <a href="<?php echo base_url('admin/Produto/create' .'/'. query_string('?')) ?>" class="btn btn-success btn-sm pull-right">
		                    <i class="fa fa-plus"></i>
		                Adicionar</a>
		            </div>

		        </div>
		    </div>
		    <div class="box-body">

				<form action="<?php echo base_url('admin/Anunciante') ?>" method="get">
				    <div class="panel panel-default">
				        <div class="panel-heading">Pesquisar</div>
				        <div class="panel-body">
				            <div class="row">
				                <div class="col-md-3">
				                    <div class="form-group">
				                        <label>Anunciante</label>
				                        <input class="form-control" type="text" name="nm_anunciante" value="<?php echo $this->input->get('nm_anunciante')?>" >
				                    </div>
				                </div>
				                <div class="col-md-3">
				                    <div class="form-group">
				                        <label>E-mail</label>
				                        <input class="form-control" type="text" name="email" value="<?php echo $this->input->get('email')?>" >
				                    </div>
				                </div>
				            </div>

				            <div class="row">
				                <div class="col-md-12 text-right">
				                	<a class="btn btn-default" href="<?php echo base_url('admin/Anunciante') ?>">Limpar</a>
				                	&nbsp;
				                    <button class="btn btn-success" type="submit">
				                      <span class="glyphicon glyphicon-search"></span> Pesquisar
				                    </button>

				                </div>
				            </div>
				        </div>
				    </div>
				</form>



<!-- 			<?php if($paginacao): ?>
		    <div class="box-footer clearfix">
		        <ul class="pagination pagination-sm no-margin pull-right">
					<?php echo $paginacao ?>
		        </ul>
		    </div>
		    <?php endif; ?> -->

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
