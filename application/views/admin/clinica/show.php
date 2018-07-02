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

        <div class="row">

            <div class="col-md-3">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados básicos</h3>
                    </div>

                    <div class="box-body">
                        <a class="btn btn-xs btn-primary" href="<?php echo base_url('admin/Clinica/edit/'.$clinica->id_clinica) ?>">Editar</a>
                    </div>

                    <div class="box-body no-padding">

                        <?php if( ! empty( $clinica->img_capa ) ): ?>
                            <img class="img-responsive" src="<?php echo base_url() ?>arquivo/clinica/capa_<?php echo $clinica->img_capa ?>">
                        <?php endif; ?>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nome</td>
                                    <td><?php echo $clinica->nm_clinica ?></td>
                                </tr>
                                <tr>
                                    <td>Descrição</td>
                                    <td><?php echo $clinica->descricao_clinica ?></td>
                                </tr>
                                <tr>
                                    <td>Horário de funcionamento</td>
                                    <td><?php echo $clinica->horario_funcionamento ?></td>
                                </tr>
                                <tr>
                                    <td>Ativo</td>
                                    <td><?php echo  booleanText('Sim', 'Não', $clinica->clinica_ativo) ?></td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td><?php echo $municipio->nm_estado ?></td>
                                </tr>
                                <tr>
                                    <td>Cidade</td>
                                    <td><?php echo $municipio->nm_municipio ?></td>
                                </tr>
                                <tr>
                                    <td>Bairro</td>
                                    <td><?php echo $clinica->bairro ?></td>
                                </tr>
                                <tr>
                                    <td>Logradouro</td>
                                    <td><?php echo $clinica->logradouro ?></td>
                                </tr>
                                <tr>
                                    <td>Nímero</td>
                                    <td><?php echo $clinica->numero ?></td>
                                </tr>
                                <tr>
                                    <td>Complemento</td>
                                    <td><?php echo $clinica->complemento ?></td>
                                </tr>
                                <tr>
                                    <td>CEP</td>
                                    <td><?php echo $clinica->cep ?></td>
                                </tr>

                                <tr>
                                    <td>Como chegar</td>
                                    <td><?php echo $clinica->como_chegar ?></td>
                                </tr>
                                <tr>
                                    <td>Rota</td>
                                    <td>

                                       <input type="text" class="form-control" value="<?php echo $clinica->link_rota ?>" disabled>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div><!--/box endereço-->
            </div><!-- /col-md-4 -->

            <div class="col-md-5">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Especialidades</h3>
                    </div>

                    <div class="box-body">
                        <a class="btn btn-xs btn-primary" href="<?php echo base_url('admin/Clinica/createEspecialidade/'.$clinica->id_clinica) ?>">
                        Adicionar
                        </a>
                    </div>

                    <div class="box-footer no-padding">

                        <table class="table">

                            <thead>
                                <tr>
                                    <th>Especialidade</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Ativo</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach($especialidades as $especialidade): ?>

                                <tr>
                                    <td><?php echo $especialidade->nm_especialidade ?></td>
                                    <td><?php echo $especialidade->nm_tipo_especialidade ?></td>
                                    <td><?php echo $especialidade->valor ?></td>
                                    <td><?php echo  booleanText('Ativo na clínica', 'inativo na clínica', $especialidade->especialidade_clinica_ativo) ?>  </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/Clinica/editEspecialidade/'. $clinica->id_clinica .'/'. $especialidade->especialidade_id ) ?>" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a>
                                    </td>
                                </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div><!--/box endereço-->
            </div><!-- /col-md-4 -->

            <div class="col-md-4">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Profissionais de saúde</h3>
                    </div>

                    <div class="box-body">
                        <a class="btn btn-xs btn-primary" href="<?php echo base_url('admin/Clinica/createProfissional/'. $clinica->id_clinica ) ?>">
                        Adicionar
                        </a>
                    </div>

                    <div class="box-footer no-padding">

                        <table class="table">
                            <tbody>
                                <?php foreach($profissionais as $profissional): ?>

                                <tr>
                                    <td><?php echo $profissional->nm_profissional ?></td>
                                    <td><?php echo booleanText('Disponível', 'Indisponível', $profissional->disponivel) ?></td>
                                    <td>
                                        <a class="btn btn-default btn-xs pull-right" href="<?php echo base_url('admin/Clinica/horarios/'.$clinica->id_clinica . '/' .$profissional->id_profissional) ?>">Disponibilidade</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/Clinica/createProfissional/'. $clinica->id_clinica .'/'. $profissional->id_profissional ) ?>" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a>
                                    </td>
                                </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div><!--/box endereço-->
            </div><!-- /col-md-4 -->

        </div>


    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php $this->load->view('admin/partes/footer') ?>

