<?php  $this->load->view('admin/partes/header') ?>
<div class="page-bar">
	<div class="wrap">
		<h1 class="tt-page">
			<span>Usuários - alterar usuário</span>
			<?php echo anchor('admin/usuario/create','Adicionar novo usuário', 'class="btn btn-bar btn-success right"') ?>
		</h1>
	</div>
</div>

<div class="wrap">

	<ul class="breadcrumbs">
		<?php echo $this->breadcrumbs->exibe() ?>
	</ul>

	<?php echo $this->mensagem->exibirTodas() ?>


	<?php echo form_open_multipart('admin/usuario/update') ?>

	<div class="linha">
		<?php echo anchor('admin/usuario/update/' . $usuario->id_usuario, 'alterar', 'class="btn btn-small btn-warning   mrg-l right"') ?>
		<?php echo anchor('admin/usuario/delete/' . $usuario->id_usuario, 'excluir', 'class="btn btn-small btn-danger delete mrg-l right	"') ?>
	</div>
	<div class="panel">
		<h2 class="panel-header"> Dados básicos </h2>

		<input type="hidden" name="id"  value="<?php echo set_value('id',$usuario->id_usuario) ?>">
		<div class="linha">

			<div class="col col-2">
				<?php if( ! empty( $usuario->foto ) ): ?>
			    	<img class="avatar-upload" src="<?php echo base_url() ?>arquivo/usuario/grande_<?php echo $usuario->foto ?>">
				<?php else: ?>
					<img class="avatar-upload" src="<?php echo base_url() ?>assets/images/elementos/perfil-default.png">
				<?php endif; ?>
			</div>

			<div class="col col-5">

				<div class="linha">
					<b>Nome:</b> <?php echo $usuario->nm_usuario ?>
				</div>
				<div class="linha">
					<b>E-mail:</b> <?php echo $usuario->email ?>
				</div>
				<div class="linha">
					<b>Telefone:</b> <?php echo $usuario->telefone ?>
				</div>
				<div class="linha">
					<b>Celular:</b> <?php echo $usuario->celular ?>
				</div>
			</div>
		</div>

	</div>




</div><!-- wrap content -->

<?php $this->load->view('admin/partes/footer') ?>


