    
	<?php if(count( $historico ) == 0): ?>
    <div class="documento" style="margin-bottom: 20px ">
        <div class="documento-header">
        	Não possui histórico
        </div>
    </div>
	<?php endif ?>


	<?php foreach ($historico as $hist): ?>
    <div class="documento" style="margin-bottom: 20px ">
        <div class="documento-header">
            <?php echo stringDateSimple( dateTimeToDate($hist->inicio_agendamento)  ) ?>                
        </div>
        <div class="documento-body">
            <b>Especialidade</b> <?php echo $hist->nm_especialidade ?> <br><br>

<h3 class="documento-tt">Anamnese</h3>
<b>QPD(Queixa principal de duração):</b> <?php echo $hist->historico['anamnese']->qpd ?> <br> 
<b>HDA(História da doença atual):</b> <?php echo $hist->historico['anamnese']->hda ?> <br> 
<b>História Familiar:</b> <?php echo $hist->historico['anamnese']->historia_familiar ?> <br> 
<b>História Médica Pregressa:</b> <?php echo $hist->historico['anamnese']->historia_medica_pregressa ?> <br> 
<b>Interrogação diversos sistemas:</b> <?php echo $hist->historico['anamnese']->interrogacao_diversos_sistemas ?> <br> 
<b>Cabeça:</b> <?php echo $hist->historico['anamnese']->cabeca ?> <br> 
<b>Olhos:</b> <?php echo $hist->historico['anamnese']->olhos ?> <br> 
<b>Nariz e seios da face:</b> <?php echo $hist->historico['anamnese']->nariz_seios_face ?> <br> 
<b>Boca e garganta: </b><?php echo $hist->historico['anamnese']->boca_garganta ?> <br> 
<b>Pescoço:</b> <?php echo $hist->historico['anamnese']->pescoco ?> <br>
<b>Pulmões:</b> <?php echo $hist->historico['anamnese']->pulmoes ?> <br>
<b>Uso de medicamentos:</b> <?php echo $hist->historico['anamnese']->uso_medicamentos ?> <br><br>

<h3 class="documento-tt">Exame físico</h3>

<b> Queixa:</b> <?php echo $hist->historico['exame_fisico']->queixa ?> <br>
<b>FR:</b> <?php echo $hist->historico['exame_fisico']->fr ?> <br>
<b>FC:</b> <?php echo $hist->historico['exame_fisico']->fc ?> <br>
<b>Temperatura:</b> <?php echo $hist->historico['exame_fisico']->temperatura ?> <br>
<b>Dextro:</b> <?php echo $hist->historico['exame_fisico']->dextro ?> <br>
<b>Cabeça/Pescoço:</b> <?php echo $hist->historico['exame_fisico']->cabeca_pescoco ?> <br>
<b>Abdomen:</b> <?php echo $hist->historico['exame_fisico']->torax_abdome ?> <br>
<b>MMS:</b> <?php echo $hist->historico['exame_fisico']->mms ?> <br>
<b>MMI:</b> <?php echo $hist->historico['exame_fisico']->mmi ?> <br>
<b>Histórico:</b> <?php echo $hist->historico['exame_fisico']->historico ?> <br>
<b>Observações :</b> <?php echo $hist->historico['exame_fisico']->observacoes_med ?> <br><br>

<h3 class="documento-tt">Exames</h3>

<?php foreach ($hist->historico['procedimentos'] as $proc): ?>
	<?php foreach ($proc->respostas as $resposta): ?>

		<b>Procedimento</b>:  <?php echo $resposta->procedimento ?><br>

	<?php endforeach ?>
<?php endforeach ?>


<h3 class="documento-tt">Prescrições</h3>

<?php foreach ($hist->historico['prescricoes'] as $presc): ?>
	<?php foreach ($presc->respostas as $resposta): ?>

		<b>Medicamento</b>:  <?php echo $resposta->medicamento ?><br>

	<?php endforeach ?>
<?php endforeach ?>


<h3 class="documento-tt">Anotações</h3>

<?php foreach ($hist->historico['anotacoes'] as $an): ?>
	<?php foreach ($an->respostas as $resposta): ?>

		<b>Anotação</b>:  <?php echo $resposta->anotacao ?><br>

	<?php endforeach ?>
<?php endforeach ?>



        </div>
    </div>
	<?php endforeach ?>