<div class="documento">
   
        <div class="documento-header">
            <?php echo stringDate( date('Y-m-d')  ) ?>                
        </div>



<form action="<?php echo base_url('admin/Atendimento/consulta/saveExameFisico') ?>" method="POST">

        <input type="hidden" name="id_atendimento" class="atendimento_id" value="<?php echo $atendimento->id_atendimento ?>">
        <input type="hidden" name="id_form_atendimento" class="form_atendimento_id" value="<?php echo $exame_fisico->id_form_atendimento ?>">

        <div class="documento-body">

            <div class="form-group">
                <label>Queixa</label>
                <textarea class="form-control input-sm" name="queixa"><?php echo $exame_fisico->queixa ?></textarea>
            </div>

            <div class="form-group">
                <label>FR</label>
                <textarea class="form-control input-sm" name="fr"><?php echo $exame_fisico->fr ?></textarea>
            </div>

            <div class="form-group">
                <label>FC</label>
                <textarea class="form-control input-sm" name="fc"><?php echo $exame_fisico->fc ?></textarea>

            </div>

            <div class="form-group">
                <label>Temperatura</label>
                <textarea class="form-control input-sm" name="temperatura"><?php echo $exame_fisico->temperatura ?></textarea>
            </div>

            <div class="form-group">
                <label>Dextro</label>
                <textarea class="form-control input-sm" name="dextro"><?php echo $exame_fisico->dextro ?></textarea>

            </div>

            <div class="form-group">
                <label>Cabeça/Pescoço</label>
                <textarea class="form-control input-sm" name="cabeca_pescoco"><?php echo $exame_fisico->cabeca_pescoco ?></textarea>
            </div>

            <div class="form-group">
                <label>Torax/Abdomen</label>
                <textarea class="form-control input-sm" name="torax_abdome"><?php echo $exame_fisico->torax_abdome ?></textarea>


            </div>
            <div class="form-group">
                <label>MMS</label>
                <textarea class="form-control input-sm" name="mms"><?php echo $exame_fisico->mms ?></textarea>


            </div>
            <div class="form-group">
                <label>MMI</label>
                <textarea class="form-control input-sm" name="mmi"><?php echo $exame_fisico->mmi ?></textarea>

            </div>
            <div class="form-group">
                <label>Histórico</label>
                <textarea class="form-control input-sm" name="historico"><?php echo $exame_fisico->historico ?></textarea>
            </div>
            <div class="form-group">
                <label>Observações do médico</label>

                <textarea class="form-control input-sm" name="observacoes_med"><?php echo $exame_fisico->observacoes_med ?></textarea>

            </div>
            

        </div><!-- /documento-body -->

        <div class="documento-footer text-right">
            <input type="submit" class="btn btn-primary btn-save-form-prontuario" type="submit" value="Salvar">
        </div>


    </form>

</div><!-- / -->