<?php

	require_once'./lib/bancoDeDados.php'; 

	if( ! conectar()){
			
		echo("Falha ao atualizar o banco de dados!");
		return;
	}

	session_start();

	$codDono = $_SESSION["cod"];

	if (!isset($_SESSION["cod"])) : header("location: index.php"); endif;
?>
<?php
	print_r($_POST);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./material.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>Inserir imagens</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>

	<form action="inserirfotos.php" method="post" enctype="multipart/form-data" class="inserir">
		
		<label for="descricao">Descrição da foto</label>
		<input type="text" name="descricao"/><br />

		<label for="arquivo">Escolha um arquivo</label>
		<input type="file" name="arquivo"/><br />
		
		<label for="visibilidade">Imagem pública?
			<input type="checkbox" name="visibilidade"/>
		</label>
		<br/>
		<select name="canal">

			<?php 

				executarSQL(" select cod, nome from Canal where dono='$codDono' ");

				$arrResultados = recuperarResultados();

				print_r($arrResultados);

				foreach ($arrResultados as $linha) {
			?>

				<option value="<?php echo $linha["cod"];?>"> 
					<?php echo $linha["nome"];?> 
				</option>
			<?php

				}
			?>

		</select>
		<br><br>
		<button type="submit" name="Enviar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"> Inserir Foto</button>
				
	</form>
	<a href="areaUsuario.php">
			<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
				<i class="material-icons">
					photo
				</i>
			</button>
			<span>See Photos</span>
		</a>
		<br><br>
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

 <?php 
	
	function formularioEnviado(){

		return isset($_POST["descricao"]) && isset($_POST["visibilidade"]) && isset($_FILES["arquivo"]);
	}

	
	if (formularioEnviado()){

		//novo nome da foto em numeros
		$new_name = implode(explode(' ',
			implode(explode('.',
			microtime()))));

		///nome antigo do arquivo que é explodido
		$b = explode(".",$_FILES["arquivo"]["name"]);
		$x = end($b);


		//novo nome com a extensão
		$nomeDoArquivo =  rand() . $new_name . "." . $x;
		

		// print_r($nomeDoArquivo);

		$caminhoDoArquivo = $_FILES["arquivo"]["tmp_name"];

		$descricao = $_POST["descricao"];

		$visibilidade = $_POST["visibilidade"] == "on" ? 1 : 0;

		$destino = "./images/$nomeDoArquivo";

		
		$resultado = move_uploaded_file($caminhoDoArquivo, $destino);

		if($resultado){

				$cod_canal = $_POST["canal"];

				$sql = "insert into Foto (nome, descricao, visibilidade, cod_canal) values('$nomeDoArquivo','$descricao', $visibilidade, '$cod_canal')";
				executarSQL($sql);



			
		}
		else{
			echo("Falha ao enviar a imagem!");
		}
	}
	desconectar();
?>