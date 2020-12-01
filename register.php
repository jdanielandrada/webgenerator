<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body>
	<center>
		<h1><u>Registrarte es simple</></h1>
		<form action="" method="POST">
			<input type="text" name="email" placeholder="E-mail">
			<br><br>
			<input type="password" name="password" placeholder="Contraseña">
			<br><br>
			<input type="password" name="password2" placeholder="Repetir contraseña">
			<br><br>
			<input type="submit" name="ingresar" value="Registrarse">
		</form>
		<br>
		<a href="login.php">Iniciar sesion</a>
	</center>
</body>
</html>

<?php 
$hostname='localhost';
$database='webgenerator';
$username='adm_webgenerator';
$password='webgenerator2020';

	date_default_timezone_set('UTC');


	if (isset($_POST["ingresar"])) {
		if ($_POST["email"] != "" && $_POST["password"] != "") {
			if ($_POST["password"] == $_POST["password2"]) {
				$email = $_POST["email"];
				$pass = $_POST["password"];
				$fecha = date("y-m-d");

				$con = mysqli_connect($hostname, $database, $username, $password);


				if (encontrarCorreo($email)) {
					echo '<script language="javascript">alert("Ya hay un usuario registrado con ese E-mail.");</script>';
				} else {
					$sql = "INSERT INTO `usuarios`(`idUsuario`,`email`, `password`, `fechaRegistro`) VALUES (NULL,'$email','$pass','$fecha')";
					$res = mysqli_query($con, $sql);

					if (!$res) {
						echo '<script language="javascript">alert("No se pudo registrar, intentelo nuevamente mas tarde.");</script>';
					}else{
						header('Location: login.php?');				
					}
				}
				
			} else {
				echo '<script language="javascript">alert("Las contraseñas no coinciden.");</script>';
			}
			
		} else {
			echo '<script language="javascript">alert("Debe llenar todos los campos.");</script>';
		}
	}

	function encontrarCorreo($correo){
		$ssql = "SELECT * FROM `usuarios` WHERE `email`='$correo'";
		$r = mysqli_query($con, $ssql);
		if(mysqli_num_rows($r) > 0) {
			return TRUE;	
		}else{
			return FALSE;			
		}

	}
?>

