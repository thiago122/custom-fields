<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('admin_assets/css/ts-calendar.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('admin_assets/css/recepcao.css') ?>">

<div class="content-wrapper" >
    <loading></loading>
    <alert></alert>

    <section class="content-header">
        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>
    </section>

    <style>

        .constainer-documento{
            background: #dadada; 
            border-radius: 3px; 
            padding: 40px 10px;
            margin-bottom: 20px;
        }
        .documento{
            background: #fff;
            max-width: 800px; 
            margin: 0 auto;
            border-radius: 3px;
            -webkit-box-shadow: 0px 0px 10px 0px rgba(50, 50, 50, 0.35);
            -moz-box-shadow:    0px 0px 10px 0px rgba(50, 50, 50, 0.35);
            box-shadow:         0px 0px 10px 0px rgba(50, 50, 50, 0.35);
        }
        .documento-body{
            padding: 20px;
        }
        .documento-footer{
            padding: 15px 20px;
            border-top: 1px solid #c3c3c3;
            background: #e6e6e6;

            -moz-border-radius-bottomright: 3px;
            -webkit-border-bottom-right-radius: 3px;
            border-bottom-right-radius: 3px;
            -moz-border-radius-bottomleft: 3px;
            -webkit-border-bottom-left-radius: 3px;
            border-bottom-left-radius: 3px;

        }

        .documento-header{
            padding: 15px 20px;
            border-bottom: 1px solid #dadada;
            background: #f1f1f1;

            -moz-border-radius-topright: 3px;
            -webkit-border-top-right-radius: 3px;
            border-top-right-radius: 3px;
            -moz-border-radius-topleft: 3px;
            -webkit-border-top-left-radius: 3px;
            border-top-left-radius: 3px;

        }

        .documento-group{
            border: 1px solid #e6e6e6;
            background: #f7f7f7;
            padding: 10px;
            margin-bottom: 10px;
        } 
        .documento-tt{
            border-bottom: 1px solid #e6e6e6;
        }    

    </style>

    <section class="content">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                   <div class="panel-body" style="overflow: hidden">
                      
                        <img src="<?php echo base_url('admin_assets/img/perfil-default.png') ?> " class="img-responsive img-circle" style="width: 50px; float: left; margin-right: 15px">
                        
                         <div>
                            <div><b><?php echo $usuario->nm_usuario ?></b> <br></div>
                            <div><b>Estado civíl: </b> <?php echo $usuario->nm_estado_civil ?><br></div>
                            <div><b>Nascimento</b> <?php echo idade( $usuario->dt_nascimento ) ?></div>
                         </div>
                      

                   </div>
                </div>                
            </div>
            <div class="col-md-3">

                <button class="btn btn-block btn-danger stopButton" style="display:none" data-id="<?php echo $atendimento->id_atendimento ?>">
                    <span class="text-small glyphicon glyphicon-stop"></span>
                    Encerrar
                </button>
                <button class="btn btn-block btn-success startButton" style="display:none" data-status="<?php echo $atendimento->status_atendimento_id ?>" data-id="<?php echo $atendimento->id_atendimento ?>">
                    <span class="text-small glyphicon glyphicon-play"></span>
                    Iniciar
                </button>
<br>
                <button class="btn  btn-success editButton" style="display:none">
                    <span class="text-small glyphicon glyphicon-edit"></span>
                    Editar
                </button>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">




                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#historico" data-toggle="tab" aria-expanded="true">Histórico</a></li>
                        <li class="public "><a href="#anamnese" data-toggle="tab" aria-expanded="true">Anamnese</a></li>
                        <li class="public"><a href="#exame_fisico" data-toggle="tab" aria-expanded="false">Exame físico</a></li>

                        <li class="public "><a href="#exames" data-toggle="tab" aria-expanded="false">Exames</a></li>
                        <li class="public"><a href="#prescricoes" data-toggle="tab" aria-expanded="false">Prescrições</a></li>
                        <li class="public"><a href="#anotacoes" data-toggle="tab" aria-expanded="false">Anotações</a></li>
                    </ul>
                    <div class="tab-content">
  
                        <div class="tab-pane active" id="historico">
                            <div class="constainer-documento">
                                <?php $this->load->view('admin/consulta/formularios/historico') ?>
                            </div> 
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane " id="anamnese">
                            <div class="constainer-documento">
                                <?php $this->load->view('admin/consulta/formularios/anamnese') ?>
                            </div> 
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane " id="exame_fisico">
                            <div class="constainer-documento">
                                <?php $this->load->view('admin/consulta/formularios/exame_fisico') ?>
                            </div>
                        </div><!-- /.tab-pane -->



                        <div class="tab-pane " id="exames">
                           <div class="constainer-documento">
                                <?php $this->load->view('admin/consulta/formularios/procedimento') ?>
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane " id="prescricoes">
                            <div class="constainer-documento">
                                <?php $this->load->view('admin/consulta/formularios/prescricao') ?>
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="anotacoes">
                            <div class="constainer-documento">
                                <?php $this->load->view('admin/consulta/formularios/anotacoes') ?>
                            </div>
                        </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                </div>


            </div><!-- /col-md-12 -->
        </div><!-- /row -->
    </section><!-- /.content -->



</div><!-- /.content-wrapper -->


<script>
    setTimeout(function(){
        $('body').addClass('sidebar-collapse')
    }, 1000 );
</script>

<?php $this->load->view('admin/partes/footer', []) ?>
