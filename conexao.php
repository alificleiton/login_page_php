<?php

	date_default_timezone_set('America/Sao_Paulo');

	define('HOST', 'localhost');
	define('USUARIO', 'root');
	define('SENHA', '');
	define('BD', 'help_desk');

	$conexao = mysqli_connect(HOST, USUARIO, SENHA, BD) or die('Não conectou');


?>