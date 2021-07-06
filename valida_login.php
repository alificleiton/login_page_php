<?php
	include_once('conexao.php');
	session_start();

	//pega do post os valores e adiciona nas variáveis
	$email = mysqli_real_escape_string($conexao, $_POST['email']);
	$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

	//verfica no banco de dados se possui o usuario e senha
	$query = "select * from login where email = '$email' and senha = '$senha' ";
	$result = mysqli_query($conexao, $query);
	$dado = mysqli_fetch_array($result);                    	
	$linha = mysqli_num_rows($result);

	//se linha retornar um valor maior que zero quer dizer que encontrou
	if($linha > 0){

		//pega os dados do usuario
		$_SESSION['usuario'] = $email;
		$_SESSION['nivel'] = $dado['nivel'];
		$_SESSION['login_id'] = $dado['id'];

		$_SESSION['autenticado'] = 'SIM';
		header('Location: home.php');

		
	}else{

		$_SESSION['autenticado'] = 'NAO';
		header('Location: index.php?login=erro');
		
	}


?>