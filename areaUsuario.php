<?php 
	require_once 'lib/bancoDeDados.php';

	session_start ();

	if( ! conectar()){
			
		echo("Falha ao atualizar o banco de dados!");
		return;
	}

	$codUsuario = $_SESSION["cod"];

	// print_r($_SESSION);

	// print_r($codUsuario);

	// executarSQL(" select cod from canal where dono='$codUsuario' ");

	// $arrRes = recuperarResultados();
	
	
	// $arrRes = $arrRes[0]["cod"];

	// print_r($arrRes);

	executarSQL(" select cod_canal from usuario_canal where cod_usu='$codUsuario' ");

	$res = recuperarResultados();

	$res = $res[0]["cod_canal"];

	// print_r($res);

	executarSQL("select nome, descricao from foto where cod_canal='$res' ");

	$response = recuperarResultados();

	// var_dump($response);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link rel="stylesheet" href="./material.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="css/areaUsuario.css">

		<style>
		.demo-card-image.mdl-card {
		  width: 300px;
		  height: 300px;

		}
		.demo-card-image > .mdl-card__actions {
		  height: 52px;
		  padding: 16px;
		  background: rgba(0, 0, 0, 0.2);
		}
		.demo-card-image__filename {
		  color: #fff;
		  font-size: 14px;
		  font-weight: 500;
		}
		</style>
	</head>
	<body>
		<h1>Fotos do Usuario</h1>
		<div class="container">
			<div class="wrap">
				<?php foreach ($response as $key => $value): ?>
					<div class="demo-card-image mdl-card mdl-shadow--2dp" style="background: url('./images/<?php echo $value["nome"];?>') center/cover ; ">
					  	
					  <div class="mdl-card__title mdl-card--expand">

					  </div>

					  <div class="mdl-card__actions">
					    <span class="demo-card-image__filename"><p><?php echo $value["descricao"]; ?></p></span>
					  </div>

					</div>
				
					

				<?php endforeach; ?>
			</div>
		</div>
		<br><br>
		<a href="principal.php">Principal</a>
		<br>
		<a href="inserirfotos.php">
			<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
			  <i class="material-icons">
				add_to_photos
				</i>
			</button>
			<span>Add Photo</span>
		</a>
		<script src="./material.min.js"></script>
	</body>
	</html>

<?php desconectar(); ?>