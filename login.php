<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body>
	<center>
		<h1><u>WebGenerator</u></h1>
		<form action="" method="POST">
			<input type="text" name="e-mail" placeholder="E-mail">
			<br><br>
			<input type="password" name="password" placeholder="Contraseña">
			<br><br>
			<input type="submit" name="ingresar" value="Iniciar sesion">
		</form>
		<br>
		<a href="register.php">Registrarse</a>
	</center>
</body>
</html>

<?php 
$hostname='localhost';
$database='webgenerator';
$username='adm_webgenerator';
$password='webgenerator2020';

	session_start();
	if (isset($_POST["ingresar"])) {
		if ($_POST["e-mail"] != "" && $_POST["password"] != "") {
			
			$email = $_POST["e-mail"];
			$pass = $_POST["password"];

			$con = mysqli_connect($hostname, $database, $username, $password);

			$sql = "SELECT * FROM `usuarios` WHERE `email`='$email'  AND `password`='$pass'";
			$res = mysqli_query($con, $sql);

			if (mysqli_num_rows($res) > 0) {
				while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
					$_SESSION["id"] = $fila["idUsuario"];
					$_SESSION["email"] = $fila["email"];
					$_SESSION["pass"] = $fila["password"];
				header('Location: panel.php?');					
				}
			}else{
				echo '<script language="javascript">alert("E-mail o contraseña incorrectas.");</script>';			
			}
		} else {
			echo '<script language="javascript">alert("Debe llenar todos los campos para continuar.");</script>';
		}
	}


 ?>