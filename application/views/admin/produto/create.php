<?php $this->load->view('admin/partes/header.php'); ?>
<?php $this->load->view('admin/partes/header-bar.php'); ?>
<?php $this->load->view('admin/partes/sidebar.php'); ?>

<div class="content-wrapper" id="app">

    <section class="content-header">
        <h1>Anunciante</h1>

        <ol class="breadcrumb"><?php echo $this->breadcrumbs->exibe() ?></ol>

    </section>

    <section class="content">

        <?php echo $this->mensagem->exibirTodas() ?>

        <?php echo form_open_multipart('admin/anunciante/store/'. '/' . query_string('?')) ?>


        <div class="row">
            <div class="col-md-8">

                <div class="box no-border">
                    <div class="box-body">
                        <div class="form-group">
                            <label >Nome</label>
                            <input class="form-control" type="text" name="nm_anunciante"  value="<?php echo set_value('nm_produto') ?>">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea  class="form-control" name="descricao" rows="6"><?php echo set_value('descricao') ?></textarea>
                        </div>
                    </div><!-- box-body -->
                </div><!-- /box -->

                <div class="box no-border">
                    <div class="box-body">
                        <h4>Imagens
                        <a href="#" class="btn btn-xs btn-primary pull-right"> Adicionar imagem</a>
                        </h4>
                    </div><!-- box-body -->

                    <div class="box-body">
                        Listagem de imagens
                    </div><!-- box-body -->
                </div><!-- /box -->


                <div class="box no-border">

                    <div class="box-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Preco</th>
                                    <th>Preco promocional</th>
                                    <th>SKU</th>
                                    <th>COD Barra</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="produto in produtos">
                                    <td><input class="form-control input-sm" type="text" v-model="produto.preco"></td>
                                    <td><input class="form-control input-sm" type="text" v-model="produto.preco_promocional"></td>
                                    <td><input class="form-control input-sm" type="text" v-model="produto.sku"></td>
                                    <td><input class="form-control input-sm" type="text" v-model="produto.cod_barra"></td>
                                    <td><button class="btn btn-xs">+</button></td>
                                </tr>
                            </tbody>
                        </table>

                    </div><!-- box-body -->
                </div><!-- /box -->


                <div class="box no-border hidden">
                    <div class="box-header with-border">
                        <h4 class="box-title">Preço</h4>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Preço original</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Preço promocional</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                    </div><!-- box-body -->
                </div><!-- /box -->


                <div class="box no-border hidden">
                    <div class="box-header with-border">
                        <h4 class="box-title">Estoque</h4>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >SKU</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Código de barras</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox"><label><input type="checkbox">Controlar estoque?</label></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Quantidade em estoque</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                    </div><!-- box-body -->
                </div><!-- /box -->

                <div class="box no-border  hidden">
                    <div class="box-header with-border">
                        <h4 class="box-title">Frete</h4>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox"><label><input type="checkbox">Este produto possui frete grátis?</label></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Peso</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Comprimento</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Largura</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Altura</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                    </div><!-- box-body -->
                </div><!-- /box -->

                <div class="box no-border  hidden">
                    <div class="box-header with-border">
                        <h4 class="box-title">Variações</h4>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Propriedade</label>
                                    <select name="" class="form-control">
                                        <option value="">Cor</option>
                                        <option value="">Tamanho</option>
                                        <option value="">Material</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <div><label>&nbsp;</label></div>
                                    <input type="button" class="btn btn-primary" value="Adicionar para este produto">
                                </div>
                            </div>
                        </div>

                    </div><!-- box-body -->
                </div><!-- /box -->


                <div class="box no-border hidden">
                    <div class="box-header with-border">
                        <h4 class="box-title">SEO</h4>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Título para SEO</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Descrição para SEO</label>
                                    <input class="form-control" type="text" name=""  value="">
                                </div>
                            </div>
                        </div>

                    </div><!-- box-body -->
                </div><!-- /box -->


            </div><!-- col-8 COLUNA ESQUERDA -->

            <div class="col-md-4">

                <div class="box no-border">
                    <div class="box-body">

                        <div class="form-group">
                            <label >Data de publicação</label>
                            <input class="form-control" type="text" name="nm_anunciante"  value="<?php echo set_value('nm_produto') ?>">
                        </div>

                    </div><!-- box-body -->
                </div><!-- /box -->

                <div class="box no-border">
                    <div class="box-body">

                        <label >Categorias</label>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                                <div class="checkbox"><label><input type="checkbox">Categoria</label></div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label >Tags</label>
                            <input class="form-control" type="text" name="nm_anunciante"  value="<?php echo set_value('nm_produto') ?>">
                        </div>

                        <hr>

                        <div class="form-group">
                            <label >Marca</label>
                            <input class="form-control" type="text" name="nm_anunciante"  value="<?php echo set_value('nm_produto') ?>">
                        </div>


                    </div><!-- box-body -->
                </div><!-- /box -->

            </div><!-- col-4 COLUNA DIREITA -->
        </div><!-- row -->


        <div class="row">
            <div class="col-md-12 ">

                <div class="box no-border">
                    <div class="box-body text-center">
                        <a type="submit" href="<?php echo base_url('admin/usuario') ?>" class="btn btn-default">Cancelar</a>
                        <input type="submit" class="btn btn-success" value="Salvar">
                    </div><!-- box-body -->
                </div><!-- /box -->

            </div>
        </div>

        <?php echo form_close() ?><!-- form -->



    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<?php

$dados['scripts'] = [
    'vue/vue.js',
    'vue/produto.js'
];

$this->load->view('admin/partes/footer', $dados);

?>

