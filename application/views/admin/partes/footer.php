        <div class="control-sidebar-bg"></div>

      </div><!-- ./wrapper -->

      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->


    <script src="<?php echo base_url('admin_assets/js/jQuery/jQuery-2.1.4.min.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/bootstrap.min.js') ?>"></script>

    <script src="<?php echo base_url('admin_assets/js/notify/bootstrap-notify.min.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/datepicker/bootstrap-datepicker.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/mask/jquery.mask.min.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/validate/jquery.validate.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/select2/select2.min.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/datepicker/locales/bootstrap-datepicker.pt-BR.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/moment/moment-with-locales.js') ?>"></script>

<!--     <script src="<?php echo base_url('admin_assets/js/mapa/ui.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/mapa/admin-maps.js') ?>"></script>
    <script src="<?php echo base_url('admin_assets/js/mapa/localidades.js') ?>"></script> -->

    <script src="<?php echo base_url('admin_assets/js/especialidade-clinica.js') ?>"></script><!-- bootstrap-notify -->
    <script src="<?php echo base_url('admin_assets/js/horarios-medico.js') ?>"></script><!-- bootstrap-notify -->
    <script src="<?php echo base_url('admin_assets/js/easytimer.min.js') ?>"></script><!-- bootstrap-notify -->
    <script src="<?php echo base_url('admin_assets/js/custom.js') ?>"></script><!-- bootstrap-notify -->
    <script src="<?php echo base_url('admin_assets/js/prontuario.js') ?>"></script><!-- bootstrap-notify -->
    <script src="<?php echo base_url('admin_assets/js/app.min.js') ?>"></script><!-- AdminLTE App -->
    <?php
    if( isset($scripts) ): ?>
    <?php foreach ($scripts as $script):?>

    <script src="<?php echo base_url('admin_assets/js/'.$script) ?>"></script>
    <?php endforeach;?>
    <?php endif; ?>

    <script src="<?php echo base_url('admin_assets/js/main.js') ?>"></script>

  </body>

</html>

