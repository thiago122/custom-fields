<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Atendimentos: <?php echo stringDate(date('Y-m-d')) ?></h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <!-- Main content -->
    <section class="content">


        <?php foreach ($atendimentos as $atendimento): ?>
        
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                   <div class="panel-body" style="overflow: hidden">
                      
                        <img src="<?php echo base_url('admin_assets/img/perfil-default.png') ?> " class="img-responsive img-circle" style="width: 70px; float: left; margin-right: 15px">
                        
                         <div>
                            <div>Paciente: <b><?php echo $atendimento->nm_agendante ?></b> <br></div>
                    
                            <div>Especialidade <b><?php echo $atendimento->nm_especialidade?></b></div>
                            <div>Hora: <b><?php echo dateTimeToTime($atendimento->inicio_agendamento) ?></b></div>
                            <div>Status: <b><?php echo $atendimento->nm_status_atendimento?></b></div>



<?php if($atendimento->id_status_atendimento < 4 ): ?>
    <a href="<?php echo base_url('admin/atendimento/Consulta/consulta/'.$atendimento->id_atendimento ) ?>" class="btn btn-xs btn-default">visualizar</a>
<?php endif ?>

<?php if($atendimento->id_status_atendimento == 4 ): ?>
    <a href="<?php echo base_url('admin/atendimento/Consulta/consulta/'.$atendimento->id_atendimento ) ?>" class="btn btn-xs btn-success">Iniciar consulta</a>
<?php endif ?>

<?php if($atendimento->id_status_atendimento == 5): ?>
    <a href="<?php echo base_url('admin/atendimento/Consulta/consulta/'.$atendimento->id_atendimento ) ?>" class="btn btn-xs btn-success">continuar</a>
<?php endif ?>

<?php if($atendimento->id_status_atendimento > 5): ?>
    <a href="<?php echo base_url('admin/atendimento/Consulta/consulta/'.$atendimento->id_atendimento ) ?>" class="btn btn-xs btn-warning">visualizar</a>
<?php endif ?>




                         </div>
                   </div>
                </div>                
            </div>

        </div>

        <?php endforeach ?>



    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
