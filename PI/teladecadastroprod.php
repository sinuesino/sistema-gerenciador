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

<div class="bemvindo"><h2>Cadastro de produto</h2></div>
  <form action="teladecadastroprod.php" method="post">
    <div class="corpo">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nome do Produto</span>
        <input type="text" name="nomeprod" class="form-control" placeholder="Insira nome" aria-label="Username" aria-describedby="basic-addon1">
      </div>
      
      <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Categoria</label>
        <select class="form-select" name="categoriaprod" id="inputGroupSelect01">
          <option value="">Selecione uma categoria</option>
          <?php
          
          $query = $conn->query("SELECT * FROM categoria ORDER BY nome_cat ASC");
          $registros = $query-> fetchAll();
          
          foreach($registros as $option) {
              ?>
                  <option value="<?php echo $option['id_cat']?>"><?php echo $option['nome_cat'] ?></option>
              <?php
              }
          ?>
        </select>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Insira o valor do produto:</span>
        <input type="text" name="valorprod" class="form-control" placeholder="R$:" aria-label="Username" aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Insira quantidade de unidades:</span>
        <input type="text" name="quantidadeprod" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
      </div>
      
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Insira o código do produto:</span>
        <input type="text" name="codigoprod" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
      </div>
      <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
      <a href="teladeselecaocad.html" class="btn btn-secondary">Voltar</a>

    </form>
</div>

<?php 
if (isset($_POST['cadastrar'])) {
    $nomeprod = $_POST['nomeprod'];
    $categoriaprod = $_POST['categoriaprod'];
    $valorprod = $_POST['valorprod'];
    $quantidadeprod = $_POST['quantidadeprod'];
    $codigoprod = $_POST['codigoprod'];
    if ($nomeprod == "" || $categoriaprod == "" || $valorprod == "" || $quantidadeprod == "" || $codigoprod == "") {
        echo "<div class='alert alert-danger'>Complete todos os campos</div>";
    } else {
        $ver = $conn->prepare("SELECT * FROM `produto` WHERE `nome_prod` = :nomeprod AND `situacao_prod` = 1");
        $ver->bindValue(":nomeprod", $nomeprod);
        $ver->execute();
        if ($ver->rowCount() > 0) {
            echo "<div class='alert alert-danger'>Produto já cadastrado 
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            $grava = $conn->prepare("INSERT INTO `produto` (`nome_prod`, `cat_prod`, `valor_prod`, `estoque_prod`,`cod_prod`, `situacao_prod`) VALUES (:nomeprod, :categoriaprod, :valorprod, :quantidadeprod, :codigoprod, 1)");
            $grava->bindValue(":nomeprod", $nomeprod);
            $grava->bindValue(":categoriaprod", $categoriaprod);
            $grava->bindValue(":valorprod", $valorprod);
            $grava->bindValue(":quantidadeprod", $quantidadeprod);
            $grava->bindValue(":codigoprod", $codigoprod);
            $grava->execute();
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Gravado com sucesso!
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
    }
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>