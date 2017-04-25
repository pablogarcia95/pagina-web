<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ingresar al sistema - Usuario</title>

<link href="<?php echo base_url(); ?>public/stylesheets/login-box.css" rel="stylesheet" type="text/css" />
</head>
<body oncontextmenu="return false">
	<div style="padding: 100px 0 0 250px;">
		<div id="login-box">
			<H2>Iniciar Sesion</H2>
			<br/>
			<div id="login-box-name" style="margin-top:20px;">
				<form action="Validar/verificar" method="post">
					<label>Usuario</label> <input type="text" id="usuario" name="usuario" class="form-login" required/><br>
					<label>Clave</label> <input id="clave" name="clave" type="password" class="form-login" value="" size="30" maxlength="2048" required/><br>
					<br />
					<br />
					<input type="submit" value="Ingresar"/>
				</form>
			</div>
			<br />
			<br />
		</div>
	</div>
</body>
</html>



<!--<?= $mi_menu; ?>--> 
