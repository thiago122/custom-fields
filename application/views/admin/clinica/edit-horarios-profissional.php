<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Clínicas</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <style>
        .dia{
            width:14.2857143%;
            float: left;
        }
        .dia ul{
            padding: 0;
            list-style-type: none;
        }
        .dia ul li{
            padding: 0 5px;
            margin: 5px 2px;
            border: 1px solid #a8a8a8;
            background-color: #f1f1f1;
        }
        .dia ul li .separador{
            border-bottom: 1px solid #a8a8a8
        }
    </style>


    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

        <div class="row">
            <div class="col-md-2">

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Informações</h3>
                    </div><!-- /box-header -->

                    <div class="box-body">

                        <table class="table">
                            <tr>
                                <td>Profissional</td>
                                <td>
                                    <a href="<?php echo base_url('admin/Profissional/show/'.$profissional->id_usuario)?>" target="_blank">
                                        <?php echo $profissional->nm_usuario ?>
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>Clínica</td>
                                <td>
                                    <a href="<?php echo base_url('admin/Clinica/show/'.$clinica->id_clinica)?>" target="_blank">
                                        <?php echo $clinica->nm_clinica ?>
                                    </a>
                                </td>
                            </tr>
                        </table>

                    </div><!-- /box-body -->

                </div><!-- /box -->

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Adicionar horários</h3>
                    </div><!-- /box-header -->

                    <?php echo form_open_multipart('admin/Clinica/storeHorariosMedico/'.$clinica->id_clinica .'/', ['id' => 'sys-form-horarios']) ?>

                    <input type="hidden" name="clinica_id" value="<?php echo $clinica->id_clinica ?>">
                    <input type="hidden" name="profissional_id" value="<?php echo $profissional->id_profissional ?>">

                    <div class="box-body">

                        <div class="form-group">
                            <select name="dia" class="form-control">
                                <option value=""> Dia da semana </option>
                                <?php foreach($diasSemana as $dia): ?>

                                    <option value="<?php echo $dia->weekDay ?>"> <?php echo $dia->label ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <select name="especialidade_id" class="form-control">
                                <option value=""> Especialidade </option>
                                <?php foreach($especialidades as $especialidade): ?>
                                    <?php if($especialidade->existe == 1): ?>
                                    <option value="<?php echo $especialidade->id_especialidade ?>"> <?php echo $especialidade->nm_especialidade ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div><!-- /form-group -->

                        <div class="panel panel-default">
                            <div class="panel-body">


                                <div class="form-group" style="height: 300px; overflow-y: auto">
                                    <?php foreach($horariosDisponiveis as $horario): ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="horarios[]" value="<?php echo $horario ?>">
                                                    <?php echo $horario ?>
                                                </label>
                                            </div>
                                    <?php endforeach; ?>
                                </div><!-- /form-group -->

                            </div><!-- /panel-body -->
                        </div><!-- /panel -->


                        <div class="form-group">
                            <button class="btn btn-success btn-block" type="submit">Adicionar horários</button>
                        </div><!-- /form-group -->

                    </div><!-- /box-body -->

                    <?php echo form_close() ?><!-- form -->


                </div><!-- /box -->

            </div><!-- /col-md-3 -->

            <div class="col-md-10">

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Horários disponíveis semamalmente para este profissional nesta clínica</h3>
                    </div><!-- /box-header -->

                    <div class="box-body ">

                        <?php echo form_open_multipart('admin/Clinica/destroyHorariosMedico/'.$clinica->id_clinica .'/', ['id' => 'sys-form-rm-horario']) ?>

                        <button class="btn btn-xs btn-danger" type="submit"> Remover Selecionados </button>

                        <div class="sys-calendario-horarios">

                        </div>
                        <?php echo form_close() ?>
                    </div><!-- /box-body -->

                </div><!-- /box -->

            </div><!-- /col-md-9 -->

        </div><!-- row -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


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


<?php $this->load->view('admin/partes/footer') ?>

