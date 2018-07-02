<?php 
	// print_r($schema);

	// die();
?>



<html>
	<head></head>

	<body>
	
	<form action="<?php echo base_url('teste2/save') ?>">
		
		<?php //  echo field($schema, 'marca_carro'); ?>
	
		

		<?php if( $respostas = hasReponses($schema, 'historico_propriedade')): ?>
		
			<?php // print_r( $respostas ) ?>
			

			<?php foreach ($respostas as $resposta  ): ?>
				<?php echo field($resposta, 'nome_dono'); ?>
			<?php endforeach ?>

		<?php endif; ?>

	</form>




	</body>
</html>