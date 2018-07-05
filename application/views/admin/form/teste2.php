

<?php // print_r( $schema ) ?>

<html>
	<head></head>

	<body>
	
	<form action="<?php echo base_url('teste2/save') ?>">
		
		<label>Observações</label><br>

		<?php echo field($schema, 'observacoes'); ?><br><br>	


		<label>Possui ar condicionado</label><br>
		<?php echo field($schema, 'possui_ar_condicionado'); ?><br><br>


		<label>Marca</label><br>
		<?php echo field($schema, 'marca_carro'); ?><br><br>
	
		<label>Cor do carro</label>
		<?php echo field($schema, 'cor_carro') ?>

		<?php if( $respostas = hasReponses($schema, 'historico_propriedade')): ?>
		
			<?php foreach ($respostas as $resposta  ): ?>
				
				<label>Nome dono</label><br>
				<?php echo field($resposta, 'nome_dono'); ?><br><br>

				<label>Período</label><br>
				<?php echo field($resposta, 'periodo'); ?><br><br>

				<label>Tipo de acidente</label><br>
				<?php echo field($resposta, 'tipo_acidente'); ?><br><br>


				<hr>

			<?php endforeach ?>

		<?php endif; ?>

	</form>




	</body>
</html>