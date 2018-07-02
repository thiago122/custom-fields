<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recuperação de senha</title>
</head>

<body>
<?php echo $nome; ?>
<br/>
Você solicitou uma nova senha.<br/>

<br/>
Para cria uma nova senha copie o link abaixo no seu navegador<br/>
<?php echo base_url('login/nova_senha/'. $hash); ?>
</body>
</html>