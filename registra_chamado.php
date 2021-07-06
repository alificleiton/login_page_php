<?php
	include_once('conexao.php');
	session_start();

	$titulo = $_POST['titulo'];
  $categoria = $_POST['categoria'];
  $descricao = $_POST['descricao'];
	$id_usuario = 	$_SESSION['login_id'];

	$query = "INSERT INTO chamado (titulo, categoria, descricao, id_user) values ('$titulo', '$categoria', '$descricao', '$id_usuario')";
	$result = mysqli_query($conexao, $query);
	header('Location: home.php');
				
	

?>