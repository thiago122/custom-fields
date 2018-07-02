<?php $this->load->view('admin/partes/header.php'); ?>

<div class="content-wrapper">
    <section class="content">

    <form action="<?php echo base_url('admin/Teste/save') ?>" method="POST">


        <div class="form-group">
            <label>Toma remédios</label>
            <?php

            echo $this->builder->reset()->checkboxGroup($medicacao, $medicacao['response']);

            ?>

        </div>


        <div class="form-group">
            <label>Toma remédios</label>
            <?php

            echo $this->builder->reset()->attr(['class' => 'form-control'])->text($profissao, $profissao['response']);

            ?>
        </div>


        <div class="form-group">
            <label>Filhos</label>
            <?php
            echo $this->builder->reset()->attr(['class' => 'form-control', 'placeholder' => 'Escolha a idade'])->select($filhos,  $filhos['response']);
            ?>
        </div>

        <div class="form-group">
            <label>Fuma</label>
            <div class="checkbox">
                <label><?php echo $this->builder->reset()->checkbox($fuma, $fuma['response']); ?></label>
            </div>

        </div>


    <?php

        // echo $this->builder->groupField($_receita, $_receita['response']);

        $receitas = json_decode(json_encode( $receita ));



        echo '<div class="form-group">';
        echo '<div class="row">';
        echo '<div class="col-md-10">';
        echo $this->builder->reset()->groupField('receita')->attr(['class' => 'form-control'])->text($receitas->options->remedio);
        echo '</div>';

        echo '<div class="col-md-2">';
        echo $this->builder->reset()->groupField('receita')->attr(['class' => 'form-control'])->select($receitas->options->quantidade);
        echo '</div>';
        echo '</div>';
        echo '</div>';


        foreach ($receitas->response as $response) {
            echo '<div class="form-group">';
            echo '<div class="row">';
            echo '<div class="col-md-10">';
            echo $this->builder->groupField('receita')->attr(['class' => 'form-control'])->text($response->remedio, $response->remedio->response);
            echo '</div>';

            echo '<div class="col-md-2">';
            echo $this->builder->groupField('receita')->attr(['class' => 'form-control'])->select($response->quantidade, $response->quantidade->response);
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


     ?>


        <input class="btn" type="submit">

    </form>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('admin/partes/footer') ?>
