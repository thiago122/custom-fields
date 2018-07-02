<?php $this->load->view('admin/partes/header.php'); ?>

<div class="content-wrapper">
    <section class="content">


    <form action="<?php echo base_url('admin/Teste/save') ?>" method="post">


    <?php

        // echo $this->builder->groupField($_receita, $_receita['response']);

        $receitas = json_decode(json_encode( $_receita ));


        foreach ($receitas->response as $response) {
            echo '<div class="form-group">';
            echo '<div class="row">';
            echo '<div class="col-md-10">';
            echo $this->builder->groupField('lalal')->attr(['class' => 'form-control'])->text($response->remedio, $response->remedio->response);
            echo '</div>';

            echo '<div class="col-md-2">';
            echo $this->builder->groupField('lalal')->attr(['class' => 'form-control'])->select($response->quantidade, $response->quantidade->response);
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }


     ?>



<!--
        <div>
            <input type="text" name="receita[nome][]">
            <input type="text" name="receita[telefone][]">
        </div>

        <div>
            <input type="text" name="receita[nome][]">
            <input type="text" name="receita[receita][]">
        </div>

 -->







    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('admin/partes/footer') ?>
