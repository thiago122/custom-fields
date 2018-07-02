<?php   // var_dump($anamnese); ?>

<div class="documento">
   
        <div class="documento-header">
            <?php echo stringDate( date('Y-m-d')  ) ?>                
        </div>

        <form action="<?php echo base_url('admin/Atendimento/consulta/saveAnamnese') ?>" method="POST" class="js-form">

                <input type="hidden" name="id_atendimento" class="atendimento_id" value="<?php echo $atendimento->id_atendimento ?>">
                <input type="hidden" name="id_form_atendimento" class="form_atendimento_id" value="<?php echo $anamnese->id_form_atendimento ?>">

                <div class="documento-body">
                    <div class="form-group">
                        <label>QPD(Queixa principal de duração)</label>
                        <textarea class="form-control input-sm" name="qpd"><?php echo $anamnese->qpd ?></textarea>

                    </div>

                    <div class="form-group">
                        <label>HDA(História da doença atual)</label>
                        <textarea class="form-control input-sm" name="hda"><?php echo $anamnese->hda ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>História Familiar</label>
                        <textarea class="form-control input-sm" name="historia_familiar"><?php echo $anamnese->historia_familiar ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>História Médica Pregressa</label>
                        <textarea class="form-control input-sm" name="historia_medica_pregressa"><?php echo $anamnese->historia_medica_pregressa ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Interrogação diversos sistemas</label>
                        <textarea class="form-control input-sm" name="interrogacao_diversos_sistemas"><?php echo $anamnese->interrogacao_diversos_sistemas ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Cabeça</label>
                        <input class="form-control input-sm" type="text" name="cabeca" value="<?php echo $anamnese->cabeca ?>">


                    </div>

                    <div class="form-group">
                        <label>Olhos</label>
                        <input class="form-control input-sm" type="text" name="olhos" value="<?php echo $anamnese->olhos ?>">

                    </div>

                    
                    <div class="form-group">
                        <label>Ouvidos</label>
                        <input class="form-control input-sm" type="text" name="ouvidos" value="<?php echo $anamnese->ouvidos ?>">

                    </div>

                    <div class="form-group">
                        <label>Nariz e seios da face</label>
                        <input class="form-control input-sm" type="text" name="nariz_seios_face" value="<?php echo $anamnese->nariz_seios_face ?>">

                    </div>

                    <div class="form-group">
                        <label>Boca e garganta</label>
                        <input class="form-control input-sm" type="text" name="boca_garganta" value="<?php echo $anamnese->boca_garganta ?>">
                    </div>

                    <div class="form-group">
                        <label>Pescoço</label>
                        <input class="form-control input-sm" type="text" name="pescoco" value="<?php echo $anamnese->pescoco ?>">
                    </div>

                    <div class="form-group">
                        <label>Pulmões</label>
                        <input class="form-control input-sm" type="text" name="pulmoes" value="<?php echo $anamnese->pulmoes ?>">
                    </div>

                    <div class="form-group">
                        <label>Uso de medicamentos</label>
                        <textarea class="form-control input-sm" name="uso_medicamentos"><?php echo $anamnese->uso_medicamentos ?></textarea>
                    </div>
                </div><!-- /documento-body -->

                <div class="documento-footer text-right">
                    <input type="submit" class="btn btn-primary btn-save-form-prontuario" type="submit" value="Salvar">
                </div>

            </form>

    
</div><!-- / -->


