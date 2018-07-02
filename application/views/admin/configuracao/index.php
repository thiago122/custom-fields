<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
        <h1>
            Configurações
        </h1>
        <ol class="breadcrumb">
            <?php echo $this->breadcrumbs->exibe() ?>
        </ol>
    </section>
    <!-- page header -->

    <!-- Main content -->
    <section class="content">

		<div class="row">
			<div class="col-md-6">

			<?php echo $this->mensagem->exibirTodas() ?>

				<div class="box">

				    <div class="box-body">
				        <table class="table table-bordered">
							<thead>
								<tr>
									<th class="vertical-middle">Configuração</th>
									<th class="vertical-middle">Valor</th>
									<th class="vertical-middle" width="50"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $loop_configuracao as $configuracao): ?>
								<tr>
									<td>
										<?php echo $configuracao->label ?>
									</td>
									<td>
										<?php echo $configuracao->valor ?>
									</td>
									<td>

										<a href="<?php echo base_url('admin/configuracao/edit/' . $configuracao->id_config . '/' . query_string('?') )?>" class="btn btn-primary btn-xs">
											<span class="fa fa-edit"></span>
										</a>

									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
				    </div><!-- /.box-body -->

				</div><!-- box -->
			</div>
		</div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
