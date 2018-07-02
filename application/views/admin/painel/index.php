<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Painel de Controle</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">

            <div class="col-xs-6 col-md-6 col-lg-4">



            </div>

            <div class=" col-xs-6 col-md-6 col-lg-4"></div>

		</div>

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
