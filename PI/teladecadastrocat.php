<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <style>
        .minha-navbar {
          background-color: #35aaf3;
        }
      </style>
    <title>Document</title>
    <?php include "conn.php"; ?>
    <link rel="stylesheet" href="teladelogin.css">
</head>
<body>
<nav class="navbar navbar-expand-lg minha-navbar">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="invertario.php">
            <button type="button" class="btn btn-light">Inventário</button>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teladealerta.php">
            <button type="button" class="btn btn-light">Controle</button>
          </a>
        </li>
        <li class="nav-item">
              <a class="nav-link" href="teladerelatorio.php">
            <button type="button" class="btn btn-light">Relatórios</button>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="teladeselecaocad.html">
              <button type="button" class="btn btn-light">Gerenciamento</button>
            </a>
          </li>
          <li>
              <a>
                <button class="btn btn-danger" onclick="location.href='logout.php'">Logout</button>
              </a>
            </li>
      </ul>
    </div>
  </div>
</nav>


<div class="bemvindo"><h2>Cadastro de categoria</h2></div>

<div class="corpo">
    <form action="teladecadastrocat.php" method="post">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Insira o nome da nova categoria</span>
        <input type="text" name="categoria" class="form-control" placeholder="Insira nome" aria-label="Username" aria-describedby="basic-addon1">
        <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>

<?php
      include 'conn.php';

      if (isset($_POST['cadastrar'])) {
          $categoria = $_POST['categoria'];
          if ($categoria == "") {
              echo "<div class='alert alert-danger'>Complete todos os campos</div>";
          } else {
              $ver = $conn->prepare("SELECT * FROM `categoria` WHERE `nome_cat` = :nomecat AND `situacao_cat` = 1");
              $ver->bindValue(":nomecat", $categoria);
              $ver->execute();

              if ($ver->rowCount() > 0) {
                  echo "<div class='alert alert-danger'>Produto já cadastrado 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
              } else {
                  $grava = $conn->prepare("INSERT INTO `categoria` (`nome_cat`, `situacao_cat`) VALUES (:nomecat, 1)");
                  $grava->bindValue(":nomecat", $categoria);
                  $grava->execute();

                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Gravado com sucesso!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
              }
          }
      }
?>
      </div>
    </form>
    <a href="teladeselecaocad.html" class="btn btn-secondary">Voltar</a>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>