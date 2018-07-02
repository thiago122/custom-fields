<?php foreach($procedimentos as $procedimento): ?>

    <div class="documento">
            
            <div class="documento-header">
                <?php echo stringDate( date('Y-m-d')  ) ?>                
            </div>
            <!-- =========================================================== -->

            <form action="<?php echo base_url('admin/Atendimento/consulta/saveProcedimento') ?>" method="get" class="js-form">

                <input type="hidden" name="id_atendimento" class="atendimento_id" value="<?php echo $atendimento->id_atendimento ?>">
                <input type="hidden" name="id_form_atendimento" class="form_atendimento_id" value="<?php echo $procedimento->id_form_atendimento ?>">

                <div class="documento-body">
                    <?php foreach($procedimento->respostas as $resposta): ?>

                        <div class="js-group-field documento-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Procedimento</label>
                                        <input type="text" class="form-control input-sm" name="procedimento[][procedimento]" value="<?php echo $resposta->procedimento ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <input type="text" class="form-control input-sm" name="procedimento[][quantidade]" value="<?php echo $resposta->quantidade ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="btn btn-danger btn-xs btn-remove-item-prontuario"> 
                                    <i class="fa fa-trash"></i>
                                </span>                             
                            </div>
                        </div>
                    <?php endforeach ?>

                    <div class="form-group text-center">
                        <span class="btn btn-default btn-xs btn-duplicate-item-prontuario">Adicionar procedimento</span>
                    </div>

                </div><!-- documento-body -->

                <div class="documento-footer text-right">
                    <input class="btn btn-primary btn-save-form-prontuario" type="submit" value="Salvar">
                </div>
            </form><!-- /form -->

            <!-- =========================================================== -->

        
    </div><!-- /documento -->




<?php endforeach ?>