<?php
require_once 'lib/bancoDeDados.php';

session_start ();

if (formularioEnviado ()) {
	if (conectar ()) {
		executarSQL ( "select cod from Usuario where login='{$_POST["login"]}'
				and senha='{$_POST["senha"]}'" );

		$arrResultado = recuperarResultados ();

		if (count ( $arrResultado ) > 0) {
			// sucesso!!!!!
			$_SESSION ["cod"] = $arrResultado [0] ["cod"];
		}
	}
}

desconectar ();

if (isset ( $_SESSION ["cod"] )) {
	header ( "location: principal.php" );
	return;
}
function formularioEnviado() {
	return isset ( $_POST ["login"] ) && isset ( $_POST ["senha"] );
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./material.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<form action="index.php" method="post">
		<h1>Faça Seu Login</h1>
		<input type="text" name="login" placeholder="Nome" /> 
		<input type="password" name="senha" placeholder="Senha" />
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent primary" type="submit"> 
		Enviar</button>
	</form>
	<script src="./material.min.js"></script>
</body>
</html>






























