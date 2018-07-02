<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acesso</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/AdminLTE.min.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script> var base_url = "<?php echo base_url() ?>"</script>

  </head>
  <body class="hold-transition login-page">

    <div class="container">
        <?php echo $this->mensagem->exibir() ?>
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    </div>

    <div class="login-box">

      <div class="login-box-body">
        <p class="login-box-msg">Digite abaixo seu e-mail</p>
        <form action="<?php echo base_url('login/recuperar')?>" method="post">
          <div class="form-group has-feedback">
            <input class="form-control" name="email" type="email" placeholder="E-mail" value="<?php echo set_value('email'); ?>" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Recuperar senha</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="<?php echo base_url('login')?>">Voltar para o login</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


</html>
