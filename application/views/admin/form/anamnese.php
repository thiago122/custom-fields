<?php $this->load->view('admin/partes/header.php'); ?>

<div class="content-wrapper">
    <section class="content">


    <form action="<?php echo base_url('admin/Teste/save') ?>" method="post">

    <?php foreach ($receitas as $receita): ?>
        <?php   print_r($receita) ?>
    <?php endforeach ?>



        <div>
            <input type="text" name="receita[nome][]">
            <input type="text" name="receita[telefone][]">
        </div>

        <div>
            <input type="text" name="receita[nome][]">
            <input type="text" name="receita[receita][]">
        </div>






        <div class="form-group">
            <label>Text</label>
            <?php

            echo $this->builder
                        ->reset()
                        ->attr(['class' => 'form-control'])
                        ->text($text, $text['response']);
            ?>
        </div>

<!--         <hr>
        <div class="form-group">
            <label>Escolha a cor</label>
            <?php
            echo $this->builder
                ->attr(['class' => 'form-control'])
                ->checkboxGroup($checkbox_group, [['value' => 'azul'], ['value' => 'branco']]) ?>
        </div>
 -->
        <div class="form-group">
            <label>Toma remédios</label>
            <?php
            echo $this->builder
                ->attr(['class' => 'form-control'])
                ->checkboxGroup($toma_remedios, $toma_remedios['response']) ?>
        </div>


        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo $this->builder
                    ->attr(['class' => 'form-control'])
                    ->checkbox($checkbox, $checkbox['response']) ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo $this->builder
                    ->attr(['class' => 'form-control'])
                    ->checkbox($fuma, $fuma['response']) ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo $this->builder
                    ->attr(['class' => 'form-control'])
                    ->checkbox($bebida_alcoolica, $fuma['response']) ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Label</label>
            <?php echo $this->builder->attr(['class' => 'form-control'])->select($select, $salvo) ?>
        </div>

        <input class="btn" type="submit">
    </form>




    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('admin/partes/footer') ?>
