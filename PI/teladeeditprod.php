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

<?php
if (isset($_POST['id_prod'])) {
    $id_prod = $_POST['id_prod'];
    $query = $conn->prepare("SELECT * FROM produto WHERE id_prod = :id_prod");
    $query->bindValue(":id_prod", $id_prod);
    $query->execute();
    $produto = $query->fetch();

    if ($produto) {
        ?>
        <div class="centro">
            <div class="caixa">
                <div class="row">
                    <h2>Editar Produto</h2>
                    <form action="teladeeditprod.php" method="POST">
                        <input type="hidden" name="id_prod" value="<?php echo $produto['id_prod']; ?>" />

                        <div class="mb-3">
                            <label for="nome_prod" class="form-label">Nome do Produto</label>
                            <input type="text" name="nome_prod" id="nome_prod" class="form-control" 
                                   value="<?php echo htmlspecialchars($produto['nome_prod']); ?>" required />
                        </div>

                        <div class="mb-3">
                            <label for="categoria_prod" class="form-label">Categoria</label>
                            <select name="categoria_prod" id="categoria_prod" class="form-select" required>
                                <?php
                                $catQuery = $conn->query("SELECT * FROM categoria ORDER BY nome_cat ASC");
                                $categorias = $catQuery->fetchAll();

                                foreach ($categorias as $categoria) {
                                    $selected = ($produto['cat_prod'] == $categoria['id_cat']) ? "selected" : "";
                                    echo "<option value='".$categoria['id_cat']."' $selected>".$categoria['nome_cat']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="valor_prod" class="form-label">Preço</label>
                            <input type="text" name="valor_prod" id="valor_prod" class="form-control" 
                                   value="<?php echo htmlspecialchars($produto['valor_prod']); ?>" required />
                        </div>

                        <div class="mb-3">
                            <label for="estoque_prod" class="form-label">Estoque</label>
                            <input type="number" name="estoque_prod" id="estoque_prod" class="form-control" 
                                   value="<?php echo htmlspecialchars($produto['estoque_prod']); ?>" required />
                        </div>

                        <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />
                        <a href="teladeprod.php" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
         <?php
              } else {
                  echo "<div class='alert alert-danger'>Produto não encontrado.</div>";
              }
          } else {
              echo "<div class='alert alert-danger'>ID do produto não especificado.</div>";
          }

          if (isset($_POST['id_prod']) && isset($_POST['salvar'])) {
              $id_prod = $_POST['id_prod'];
              $nome_prod = $_POST['nome_prod'];
              $categoria_prod = $_POST['categoria_prod'];
              $valor_prod = $_POST['valor_prod'];
              $estoque_prod = $_POST['estoque_prod'];

              $update = $conn->prepare("UPDATE produto SET 
                                      nome_prod = :nome_prod, 
                                      cat_prod = :cat_prod, 
                                      valor_prod = :valor_prod, 
                                      estoque_prod = :estoque_prod 
                                      WHERE id_prod = :id_prod");
              $update->bindValue(":nome_prod", $nome_prod);
              $update->bindValue(":cat_prod", $categoria_prod);
              $update->bindValue(":valor_prod", $valor_prod);
              $update->bindValue(":estoque_prod", $estoque_prod);
              $update->bindValue(":id_prod", $id_prod);
              $update->execute();

              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Produto atualizado com sucesso!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
          }
          ?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>