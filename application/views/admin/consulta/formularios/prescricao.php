<?php  $options = [ 'Nenhum', '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'] ?>

<?php foreach($prescricoes as $prescricao): ?>

    <div class="documento">
            
            <div class="documento-header">
                <?php echo stringDate( date('Y-m-d')  ) ?>                
            </div>
            <!-- =========================================================== -->

            <form action="<?php echo base_url('admin/Atendimento/consulta/savePrescricao') ?>" method="get" class="js-form">

                <input type="hidden" name="id_atendimento" class="atendimento_id" value="<?php echo $atendimento->id_atendimento ?>">
                <input type="hidden" name="id_form_atendimento" class="form_atendimento_id" value="<?php echo $prescricao->id_form_atendimento ?>">

                <div class="documento-body">
                    <?php foreach($prescricao->respostas as $resposta): ?>

                        <div class="js-group-field documento-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Medicação</label>
                                        <input type="text" class="form-control input-sm" name="prescricao[][medicamento]" value="<?php echo $resposta->medicamento ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <select name="prescricao[][quantidade]" class="form-control  input-sm">
                                            <?php foreach($options  as $option): ?>
                                                <?php $checked = ($resposta->quantidade == $option) ? 'selected' : '' ?>
                                            <option value="<?php echo $option ?>" <?php echo $checked  ?> ><?php echo $option ?></option>
                                            <?php endforeach; ?>
                                        </select>                
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Posologia</label>
                                        <input type="text" class="form-control  input-sm" name="prescricao[][posologia]" value="<?php echo $resposta->posologia ?>">
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
                        <span class="btn btn-default btn-xs btn-duplicate-item-prontuario">Adicionar medicação</span>
                    </div>

                </div><!-- documento-body -->

                <div class="documento-footer text-right">
                    <input class="btn btn-primary btn-save-form-prontuario" type="submit" value="Salvar">
                </div>
            </form><!-- /form -->

            <!-- =========================================================== -->

        
    </div><!-- /documento -->




<?php endforeach ?>