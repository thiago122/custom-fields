

<form action="<?php echo base_url('admin/Atendimento/consulta/saveLesoes') ?>" method="POST">

        <input type="hidden" name="id_atendimento" value="<?php echo $atendimento->id_atendimento ?>">
        <input type="hidden" name="id_form_atendimento" value="<?php echo $id_form_atendimento_group_lesao ?>">

        <img style="display:block; max-width: 100%; margin: 0 auto" src="<?php echo base_url('admin_assets/img/mapa_lesoes.jpg') ?>" alt="">


<?php 


    $group_lesao = json_decode(json_encode( $group_lesao ));
    $lesoes = $group_lesao->group_lesao;


// print_r($lesoes);
// die();

?>


<style>
    .group_field{
        border: 1px solid #ccc;
        margin-bottom: 10px;
        background: whitesmoke;
        padding: 10px;
        position: relative;
    }
</style>




    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="btn btn-default btn-xs form-js-duplicate-group">Incluir nova lesão</span>
        </div>
        <div class="panel-body">
        
            <div class="js-form-duplicate">
                <div class="group_field">
                    <div class="text-right" style="margin-bottom: 10px">
                        <span class="btn btn-xs btn-danger form-js-remove-group hidden">Remover</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data</label>
                                <?php echo $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->text($lesoes->options->data); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Posição</label>
                                <?php echo  $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->text($lesoes->options->posicao); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>localização</label>
                                <?php echo $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->text($lesoes->options->localizacao); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Detalhes</label>
                                <?php echo $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->textarea($lesoes->options->detalhes); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cicatrizar</label>
                                <?php echo  $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->textarea($lesoes->options->cicatrizar); ?>
                            </div>
                        </div>

                    </div> <!-- row -->                    

                </div><!-- group_field -->


                <?php foreach($lesoes->response as $response): ?>

                <div class="group_field">
                    <div class="text-right" style="margin-bottom: 10px">
                        <span class="btn btn-xs btn-danger form-js-remove-group">Remover</span>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data</label>
                                <?php echo $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->text($response->data, $response->data->response); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Posição</label>
                                <?php echo  $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->text($response->posicao, $response->posicao->response); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>localização</label>
                                <?php echo $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->text($response->localizacao, $response->localizacao->response); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Detalhes</label>
                                <?php echo $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->textarea($response->detalhes, $response->detalhes->response); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cicatrizar</label>
                                <?php echo  $this->builder->reset()->groupField('group_lesao')->attr(['class' => 'form-control'])->textarea($response->cicatrizar,$response->cicatrizar->response); ?>
                            </div>
                        </div>

                    </div>                    
                </div>


        

                <?php endforeach; ?>



            </div><!-- js-form-duplicate -->

        </div><!-- /panel-body -->

    </div><!-- /panel -->

<div class="form-group">
    <input class="btn" type="submit">
</div>

        

</form>
