<?php
  require_once "validador_acesso.php"; 
  include_once('conexao.php'); 
 
 
?>


<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script  src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">
        
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="logoff.php"> SAIR</a>
        </li>

      </ul>
    </nav>

    <div class="container">    
    <?php

          $nivel = $_SESSION['nivel'];
          $id = $_SESSION['login_id'];

          if($nivel == 1) {
          $query = "SELECT * from chamado ";
          }else{
          $query = "SELECT * from chamado where id_user = '$id' ";
          }
                    
          $result= mysqli_query($conexao, $query);
          $linha = mysqli_num_rows($result);
          if($linha == ''){
            echo "<h3> Não foram encontrados dados Cadastrados no Banco!! </h3>";
          }else{
    ?>
        <table class="table">
            <thead class="text-secondary">
              <th> Titulo </th>
              <th> Categoria</th>
              <th>Descrição</th>                 
              <th>Ações</th>
            </thead>
            <tbody>

              <?php
                    while($res = mysqli_fetch_array($result)){
                      $titulo = $res["titulo"];
                      $categoria = $res["categoria"];
                      $descricao = $res["descricao"];
                      $id = $res["id"];
              ?>
                <td> <?php echo $titulo ?> </td>
                <td> <?php echo $categoria ?> </td>
                <td> <?php echo $descricao ?> </td>
                <td> 
                <a class="btn btn-warning" title="Editar"   href="consultar_chamado.php?func=edita&id=<?php echo $id; ?>"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger" title="Excluir" href="consultar_chamado.php?func=excluir&id=<?php echo $id; ?>"><i class="fa fa-minus-square"></i></a>
                </td>
                <tr>
              <?php } ?>
                      
              <?php
                if(@$_GET['func'] == 'edita'){
                  $id = $_GET['id'];
                  $query = "SELECT * from chamado where id = '$id' ";
                  $result= mysqli_query($conexao, $query);
                  while($res = mysqli_fetch_array($result)){
                    $titulo = $res["titulo"];
                    $categoria = $res["categoria"];
                    $descricao = $res["descricao"];
                    $id = $res["id"];
                  }
          
                  ?>
                
                      <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chamados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                      <form method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group col-md-12">
                        <label for="id_produto">Titulo</label>
                        <input type="text" class="form-control mr-2 text-dark" name="titulo" placeholder="Titulo" required value="<?php echo $titulo; ?>">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="id_produto">Categoria</label>
                        <input type="text" class="form-control mr-2 text-dark" name="categoria" placeholder="Categoria" required value="<?php echo $categoria; ?>">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="id_produto">Descrição</label>
                        <input type="text" class="form-control mr-2 text-dark" name="descricao" placeholder="Descricao" required value="<?php echo $descricao; ?>">
                      </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success " name="editar">Salvar </button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
<?php } ?>
              <?php
                if(isset($_POST['editar'])){
                      $titulo = $_POST['titulo'];
                      $descricao = $_POST['descricao'];
                      $categoria = $_POST['categoria'];

                      $query = "UPDATE chamado SET titulo = '$titulo', categoria = '$categoria', descricao = '$descricao' where id = '$id' ";

                      $result = mysqli_query($conexao, $query);

                  if($result == ''){
                    echo "<script language='javascript'>window.alert('Ocorreu um erro ao Editar!'); </script>";
                  }else{
                    echo "<script language='javascript'>window.location='consultar_chamado.php'; </script>";
                  }
                }
              ?>

              <!--EXCLUIR -->
<?php 
  if(@$_GET['func'] == 'excluir'){
    $id = $_GET['id'];
  $query = "DELETE FROM chamado where id = '$id' ";
  $result = mysqli_query($conexao, $query);
  echo "<script language='javascript'>window.location='consultar_chamado.php'; </script>";
}

?>



            </tbody>
          
          </table>
        
      <?php } ?>
     
    </div> 

    
    <script> $("#exampleModal").modal("show"); </script>
  </body>

  
</html>

