



<html>
	<head></head>

	<body>
	
	<form action="<?php echo base_url('teste2/save') ?>">
		
		<?php //  echo field($schema, 'marca_carro'); ?>
	
		

		<?php if( $respostas = hasReponses($schema, 'historico_propriedade')): ?>
		
			<?php // print_r( $respostas ) ?>
			

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