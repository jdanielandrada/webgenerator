<?php 
$hostname='localhost';
$database='webgenerator';
$username='adm_webgenerator';
$password='webgenerator2020';
	session_start();
	$con = mysqli_connect($hostname, $database, $username, $password);
	if (isset($_SESSION["id"])) {
		
		if (isset($_POST["crear"])) {
			if ($_POST["nombre"] != "") {

				$name = $_SESSION["id"].$_POST["nombre"];
				$fecha = date("y-m-d");

				if (encontrarDominio($name)) {
					echo '<script language="javascript">alert("Este dominio ya está registrado.");</script>';
				} else {
					$sql = "INSERT INTO `webs`(`idWeb`,`idUsuario`,`dominio`, `fechaCreacion`) VALUES (NULL,'".$_SESSION["id"]."','$name','$fecha')";
					$res = mysqli_query($con, $sql);

					if (!$res) {
						echo '<script language="javascript">alert("No se pudo crear la web, intentelo mas tarde.");</script>';
					}else{	
						echo '<script language="javascript">alert("Web creada exitosamente.");</script>';			
					}
				}
				shell_exec('./wix.sh '.$name);
				shell_exec('chmod 777 '.$name);
			}
		}
	} else {
		header('Location : login.php');
	}


	


	function encontrarDominio($dom){
		$con = mysqli_connect($hostname, $database, $username, $password);
		$ssql = "SELECT * FROM `webs` WHERE `dominio`='$dom'";
		$r = mysqli_query($con, $ssql);
		if(mysqli_num_rows($r) > 0) {
			return TRUE;	
		}else{
			return FALSE;			
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body>
	<center>
		<h1><u>Bienvenido a tu panel</u></h1>
		<?php 
			echo "<a href='logout.php'>Cerrar sesion de ".$_SESSION["id"]."</a>";
		?>
		<br>
		<h2>Generar Web de: </h2>
		<form action="panel.php" method="POST">
			<input type="text" name="nombre" placeholder="Nombre de la web">
			<br><br>
			<input type="submit" name="crear" value="Crear web">
		</form>
		<br><br>
		<?php 

			$con = mysqli_connect($hostname, $database, $username, $password);

			if ($_SESSION["email"] == "admin@server" && $_SESSION["pass"] == "serveradmin") {
				$ssql = "SELECT * FROM `webs` WHERE 1";
			} else {
				$ssql = "SELECT * FROM `webs` WHERE `idUsuario`='".$_SESSION["id"]."'";
			}

			$r = mysqli_query($con, $ssql);

			if(mysqli_num_rows($r) > 0) {

				while ($fila = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					shell_exec('zip -r '.$fila["dominio"].'.zip '.$fila["dominio"]);
					echo "<a href='".$fila["dominio"]."/index.php'>".$fila["dominio"]."</i></a> <a href=".$fila["dominio"].".zip>    descargar web</a><br><br>";					
				}	

			}

		 ?>
	</center>
</body>
</html>
