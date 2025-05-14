<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .minha-navbar {
            background-color: #35aaf3;
        }
    </style>
    <title>Alertas de Estoque</title>
    <?php     include 'conn.php';?>
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

<div class="bemvindo">
    <h2>Controle do Estoque</h2>
</div>
        <div class="centro">
            <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cod_prod = $_POST['cod_prod'];
                $quantidade = $_POST['quantidade'];
                try {
                    $stmt = $conn->prepare("SELECT estoque_prod FROM produto WHERE cod_prod = ?");
                    $stmt->execute([$cod_prod]);
                    $produto = $stmt->fetch();
                    if ($produto) {
                        if ($produto['estoque_prod'] >= $quantidade) {
                            $insert = $conn->prepare("INSERT INTO vendas (cod_prod, quantidade) VALUES (?, ?)");
                            $insert->execute([$cod_prod, $quantidade]);
                            $update = $conn->prepare("UPDATE produto SET estoque_prod = estoque_prod - ? WHERE cod_prod = ?");
                            $update->execute([$quantidade, $cod_prod]);

                            echo '<div class="alert alert-success" role="alert">Venda registrada e estoque atualizado com sucesso!</div>';
                        } else {
                            echo '<div class="alert alert-warning" role="alert">Estoque insuficiente para registrar a venda!</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning" role="alert">Produto não encontrado!</div>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger" role="alert">Erro ao processar a solicitação: ' . $e->getMessage() . '</div>';
                }
            }
            ?>

          <form method="post">
              <label for="cod_prod">Código do Produto:</label>
              <input type="number" name="cod_prod" id="cod_prod" required>
              <label for="quantidade">Quantidade Vendida:</label>
              <input type="number" name="quantidade" id="quantidade" required>
              <button type="submit">Registrar Venda</button>
          </form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
