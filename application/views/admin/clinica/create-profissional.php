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

        <?php echo form_open_multipart('admin/Clinica/storeProfissional/'.$clinica->id_clinica .'/' . query_string('?')) ?>

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Edição de profissional</h3>
                    </div><!-- /box-header -->

                    <div class="box-body form-horizontal">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Profissional</label>
                                    <div class="col-sm-8">
                                        <div class="custom-select-2">
                                            <select name="profissional_id" data-clinica="<?php echo $clinica->id_clinica ?>" id="autocomplete-profissional" class="form-control autocomplete custom-select-2" data-url="<?php echo base_url('admin/Profissional/find'); ?>">
                                                <option value="<?php echo $profissional->id_profissional  ?>"><?php echo  $profissional->nm_profissional ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Especialidades</label>
                                    <div class="col-lg-8 sys-especialidades-profissional">
                                    </div>
                                </div>

                            </div>

                        </div><!-- /row -->

                    </div><!-- box-body -->


                </div><!-- box -->


        <?php echo form_close() ?><!-- form -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>

