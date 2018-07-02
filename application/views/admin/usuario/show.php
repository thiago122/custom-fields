<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Usuários</h1>
        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>
    </section>

    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

        <div class="row">
            <div class="col-md-12">

                <div class="box box-widget widget-user">

                    <div class="widget-user-header bg-green">
                        <h3 class="widget-user-username"><?php echo $usuario->nm_usuario ?></h3>
                        <h5 class="widget-user-desc"><?php echo $usuario->nm_nivel ?></h5>
                    </div>

                    <div class="widget-user-image">
                        <?php if( ! empty( $usuario->foto ) ): ?>
                            <img class="img-circle" src="<?php echo base_url() ?>arquivo/usuario/media_<?php echo $usuario->foto ?>" alt="Foto do usuário">
                        <?php else: ?>
                            <img class="img-circle" src="<?php echo base_url() ?>admin_assets/img/perfil-default.png" alt="Foto do usuário">
                        <?php endif; ?>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <!-- <h5 class="description-header">3,200</h5>
                                    <span class="description-text">title data</span> -->
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <!-- <h5 class="description-header">13,000</h5>
                                    <span class="description-text">title data</span> -->
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <!-- <h5 class="description-header">35</h5>
                                    <span class="description-text">title data</span> -->
                                </div><!-- /.description-block -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <a class="btn btn-primary" href="<?php echo base_url('admin/Usuario/edit/'.$usuario->id_usuario) ?>">Editar</a>
                    </div>

                </div>

            </div><!-- /col-md-12 -->
        </div><!-- /row -->


        <div class="row">

            <div class="col-md-4">

                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados básicos</h3>
                    </div>
                    <div class="box-footer no-padding">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nome</td>
                                    <td><?php echo $usuario->nm_usuario ?></td>
                                </tr>
                                <tr>
                                    <td>Data de nascimento</td>
                                    <td><?php echo dateToBrdate($usuario->dt_nascimento) ?></td>
                                </tr>

                                <tr>
                                    <td>Sexo</td>
                                    <td><?php echo ($usuario->sexo == 'm')? 'Masculino' : 'Feminino' ?></td>
                                </tr>
                                <tr>
                                    <td>CPF</td>
                                    <td><?php echo $usuario->cpf ?></td>
                                </tr>
                                <tr>
                                    <td>RG</td>
                                    <td><?php echo $usuario->rg ?></td>
                                </tr>
                                <tr>
                                    <td>Emissor RG</td>
                                    <td><?php echo $usuario->emissor_rg ?></td>
                                </tr>
                                <tr>
                                    <td>Estado emissor</td>
                                    <td><?php echo $estadoRg->nm_estado ?></td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div><!--/box Dados-->

            </div><!-- /col-md-4 -->

           <div class="col-md-4">

                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados básicos</h3>
                    </div>
                    <div class="box-footer no-padding">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Cor</td>
                                    <td><?php echo ($usuario->nm_cor)? $usuario->nm_cor : '' ?></td>
                                </tr>

                                <tr>
                                    <td>Estado civil</td>
                                    <td><?php echo ($usuario->nm_estado_civil)? $usuario->nm_estado_civil : '' ?></td>
                                </tr>
                                <tr>
                                    <td>Nacionalidade</td>
                                    <td>
                                        <?php
                                            if( $usuario->nacionalidade == 'b' ) {
                                                echo 'Brasileiro';
                                            }
                                            if( $usuario->nacionalidade == 'e' ) {
                                                echo 'Estrangeiro';
                                            }
                                        ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Naturalidade</td>
                                    <td> <?php echo $naturalidade->nm_municipio ?> - <?php echo $naturalidade->nm_estado ?></td>
                                </tr>
                                <tr>
                                    <td>Celular</td>
                                    <td><?php echo $usuario->celular ?></td>
                                </tr>
                                <tr>
                                    <td>Fixo</td>
                                    <td><?php echo $usuario->fixo ?></td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td><?php echo $usuario->email ?></td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div><!--/box Dados-->

            </div><!-- /col-md-4 -->

            <div class="col-md-4">

                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h3 class="box-title">Endereço</h3>
                    </div>
                    <div class="box-footer no-padding">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Estado</td>
                                    <td><?php echo $endereco->nm_estado ?></td>
                                </tr>
                                <tr>
                                    <td>Cidade</td>
                                    <td><?php echo $endereco->nm_municipio ?></td>
                                </tr>
                                <tr>
                                    <td>Bairro</td>
                                    <td><?php echo $endereco->bairro ?></td>
                                </tr>
                                <tr>
                                    <td>Logradouro</td>
                                    <td><?php echo $endereco->logradouro ?></td>
                                </tr>
                                <tr>
                                    <td>Nímero</td>
                                    <td><?php echo $endereco->numero ?></td>
                                </tr>
                                <tr>
                                    <td>Complemento</td>
                                    <td><?php echo $endereco->complemento ?></td>
                                </tr>
                                <tr>
                                    <td>CEP</td>
                                    <td><?php echo $endereco->cep ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div><!--/box endereço-->

            </div><!-- /col-md-4 -->

        </div><!-- /row -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/partes/footer') ?>
