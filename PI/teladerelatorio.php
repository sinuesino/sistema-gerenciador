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

<div class="bemvindo"><h2>Relatório do Estoque</h2></div>

<div class="tabela">
    <div class="tabelacentro">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Preço (R$)</th>
                    <th scope="col">Quantidade Vendida</th>
                    <th scope="col">Valor Vendido (R$)</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $exibe = $conn->prepare("SELECT p.cod_prod, p.nome_prod, c.nome_cat, p.estoque_prod, p.valor_prod, 
                IFNULL(SUM(v.quantidade), 0) AS quantidade_vendida,
                IFNULL(SUM(v.quantidade * p.valor_prod), 0) AS valor_vendido
                FROM produto p
                JOIN categoria c ON p.cat_prod = c.id_cat
                LEFT JOIN vendas v ON p.cod_prod = v.cod_prod
                WHERE p.situacao_prod = 1
                GROUP BY p.cod_prod
            ");
            $exibe->execute();
            if ($exibe->rowCount() == 0) {
                echo "<tr><td colspan='7'>Não há registros</td></tr>";
            } else {
                while ($row = $exibe->fetch()) {
            ?>
                <tr>                   
                  <th scope="row"><?php echo $row['cod_prod']; ?></th>
                  <th scope="row"><?php echo $row['nome_prod']; ?></th>
                  <th scope="row"><?php echo $row['nome_cat']; ?></th>
                  <th scope="row"><?php echo $row['estoque_prod']; ?></th>
                  <th scope="row"><?php echo number_format($row['valor_prod'], 2, ',', '.'); ?></th>
                  <th scope="row"><?php echo $row['quantidade_vendida']; ?></th>
                  <th scope="row"><?php echo number_format($row['valor_vendido'], 2, ',', '.'); ?></th>
                </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>