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
        <p class="login-box-msg">Digite sua nova senha</p>
        <form action="<?php echo base_url('login/atualizar_senha')?>" method="post">
            <input type="hidden" name="hash" value="<?php echo $hash ?>">
          <div class="form-group has-feedback">
            <input class="form-control" name="senha" type="password" placeholder="Senha" value="<?php echo set_value('senha'); ?>" required autofocus>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input class="form-control" name="conf_senha" type="password" placeholder="Digite novamente a senha" value="<?php echo set_value('conf_senha'); ?>" required autofocus>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Alterar senha</button>
            </div><!-- /.col -->
          </div>

            <a href="<?php echo base_url('login')?>">Voltar para o login</a><br>

        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

</html>
