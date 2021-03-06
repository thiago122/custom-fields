<?php $this->load->view('admin/partes/header.php'); ?>

    <style>

        .constainer-documento{
            background: #dadada;
            border-radius: 3px;
            padding: 40px 10px;
            margin-bottom: 20px;
        }
        .documento{
            background: #fff;
            max-width: 800px;
            margin: 0 auto;
            border-radius: 3px;
            -webkit-box-shadow: 0px 0px 10px 0px rgba(50, 50, 50, 0.35);
            -moz-box-shadow:    0px 0px 10px 0px rgba(50, 50, 50, 0.35);
            box-shadow:         0px 0px 10px 0px rgba(50, 50, 50, 0.35);
        }
        .documento-body{
            padding: 20px;
        }
        .documento-footer{
            padding: 15px 20px;
            border-top: 1px solid #c3c3c3;
            background: #e6e6e6;

            -moz-border-radius-bottomright: 3px;
            -webkit-border-bottom-right-radius: 3px;
            border-bottom-right-radius: 3px;
            -moz-border-radius-bottomleft: 3px;
            -webkit-border-bottom-left-radius: 3px;
            border-bottom-left-radius: 3px;

        }

        .documento-header{
            padding: 15px 20px;
            border-bottom: 1px solid #dadada;
            background: #f1f1f1;

            -moz-border-radius-topright: 3px;
            -webkit-border-top-right-radius: 3px;
            border-top-right-radius: 3px;
            -moz-border-radius-topleft: 3px;
            -webkit-border-top-left-radius: 3px;
            border-top-left-radius: 3px;

        }

        .documento-group{
            border: 1px solid #e6e6e6;
            background: #f7f7f7;
            padding: 10px;
            margin-bottom: 10px;
        }
        .documento-tt{
            border-bottom: 1px solid #e6e6e6;
        }

    </style>



<div class="content-wrapper" >
    <section class="content">
        <div class="row">
			<div class="col-md-12">


	<form action="<?php echo base_url('teste2/save') ?>" class="js-form">

		<label>Observações</label>
		<?php echo field($schema, 'observacoes', ['class' => 'form-control']); ?>

		<label>Possui ar condicionado</label>
		<?php echo field($schema, 'possui_ar_condicionado'); ?>

		<label>Marca</label>
		<?php echo field($schema, 'marca_carro', ['class' => 'form-control']); ?>

		<div class="form-group">
            <label>Cor do carro</label>
			<?php echo field($schema, 'cor_carro',['class' => 'form-control']) ?>
        </div>






		<?php if( $respostas = hasReponses($schema, 'historico_propriedade')): ?>

			<?php foreach ($respostas as $resposta  ): ?>

				<!-- -------------------- -->
				<!-- formgroup -->
				<div class="js-group-field documento-group">
				    <div class="row">
				        <div class="col-md-4">
				            <div class="form-group">
				                <label>Nome dono</label>
								<?php echo field($resposta, 'nome_dono', ['class' => 'form-control']); ?>
				            </div>
				        </div>
				        <div class="col-md-4">
				            <div class="form-group">
				               <label>Período</label>
								<?php echo field($resposta, 'periodo', ['class' => 'form-control']); ?>
				            </div>
				        </div>
				        <div class="col-md-4">
				            <div class="form-group">
				                <label>Tipo de acidente</label>
								<?php echo field($resposta, 'tipo_acidente'); ?>
				            </div>
				        </div>
				    </div>
				    <div class="text-right">
				        <span class="btn btn-danger btn-xs btn-remove-item-prontuario">
				            <i class="fa fa-trash"></i>
				        </span>
				    </div>
				</div><!-- /formgroup -->


			<?php endforeach ?>
        <?php else: ?>

            <div class="js-group-field documento-group">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nome dono</label>
                            <?php echo field($schema['historico_propriedade']['fields'], 'nome_dono', ['class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>Período</label>
                            <?php echo field($schema['historico_propriedade']['fields'], 'periodo', ['class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo de acidente</label>
                            <?php echo field($schema['historico_propriedade']['fields'], 'tipo_acidente'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <span class="btn btn-danger btn-xs btn-remove-item-prontuario">
                        <i class="fa fa-trash"></i>
                    </span>
                </div>
            </div><!-- /formgroup -->

		<?php endif; ?>

        <div class="form-group text-center">
            <span class="btn btn-default btn-xs btn-duplicate-item-prontuario">
            Adicionar procedimento
            </span>
        </div>

		<div class="documento-footer text-right">
		    <input class="btn btn-primary btn-save-form-prontuario" type="submit" value="Salvar">
		</div>


	</form>





            </div><!-- /col-md-12 -->
        </div><!-- /row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    setTimeout(function(){
        $('body').addClass('sidebar-collapse')
    }, 1000 );
</script>

<?php $this->load->view('admin/partes/footer', []) ?>
