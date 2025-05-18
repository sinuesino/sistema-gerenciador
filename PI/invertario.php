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
  
  <div class="bemvindo"><h2>Bem-vindo ao Inventário</h2></div>
    <div class="contente">
      <div class="sidebar">
          <h4>Filtrar por Categoria</h4>
          <ul class="list-group">
              <li class="list-group-item">
                  <a href="invertario.php" class="list-group-item-action">Todos os produtos</a>
              </li>
              <?php
              $query = $conn->query("SELECT id_cat, nome_cat FROM categoria ORDER BY nome_cat ASC");
              $categorias = $query->fetchAll();

              foreach ($categorias as $categoria) {
                  echo '<li class="list-group-item">';
                  echo '<a href="invertario.php?id_cat=' . $categoria['id_cat'] . '" class="list-group-item-action">' . htmlspecialchars($categoria['nome_cat']) . '</a>';
                  echo '</li>';
              }
              ?>
          </ul>
      </div>
      <div class="containermt3">
          <div class="row">
              <?php
              if (isset($_GET['id_cat']) && $_GET['id_cat'] !== '') {
                  $id_cat = intval($_GET['id_cat']);
                  $query = "SELECT p.nome_prod, p.valor_prod, p.estoque_prod, p.cod_prod, c.nome_cat
                            FROM produto p
                            INNER JOIN categoria c ON p.cat_prod = c.id_cat
                            WHERE p.cat_prod = ? AND p.situacao_prod = 1";
                  $stmt = $conn->prepare($query);
                  $stmt->bindParam(1, $id_cat, PDO::PARAM_INT);
                  $stmt->execute();

              } else {
                  $query = "SELECT p.nome_prod, p.valor_prod, p.estoque_prod, p.cod_prod, c.nome_cat
                            FROM produto p
                            INNER JOIN categoria c ON p.cat_prod = c.id_cat
                            WHERE p.situacao_prod = 1";
                  $stmt = $conn->prepare($query);
                  $stmt->execute();
              }
              if ($stmt->rowCount() > 0):
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                      <div class="col-md-4 mb-3">
                          <div class="card" style="width: 18rem;">
                              <div class="card-header">
                                  <strong>Produto: <?php echo htmlspecialchars($row['nome_prod']); ?></strong>
                              </div>
                              <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><strong>Código:</strong> <?php echo htmlspecialchars($row['cod_prod']); ?></li>
                                  <li class="list-group-item"><strong>Categoria:</strong> <?php echo htmlspecialchars($row['nome_cat']); ?></li>
                                  <li class="list-group-item"><strong>Valor:</strong> R$ <?php echo htmlspecialchars($row['valor_prod']); ?></li>
                                  <li class="list-group-item"><strong>Estoque:</strong> <?php echo htmlspecialchars($row['estoque_prod']); ?></li>
                              </ul>
                          </div>
                      </div>
                  <?php endwhile;
              else: ?>
                  <p>Nenhum produto encontrado com status ativo.</p>
              <?php endif; ?>
          </div>
      </div>
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</script>
</body>
</html>

</body>