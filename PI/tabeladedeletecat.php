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

<div class="bemvindo"><h2>Excluir categoria</h2></div>
  
<div class="centro">
    <div class="caixa">
        <div class="row">
            <table class="table">
                <thead>
                    <a href="teladeselecaocad.html" class="btn btn-secondary">Voltar</a>
                    <tr>
                        <th scope="col">Nome da Categoria</th>
                        <th scope="col">Excluir Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $conn->query("SELECT * FROM categoria ORDER BY nome_cat ASC");
                    $categorias = $query->fetchAll();

                    foreach ($categorias as $categoria) {
                        ?>
                        <tr>
                            <td><?php echo $categoria['nome_cat']; ?></td>
                            <td>
                                <form action="teladedeletecat.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="id_cat" value="<?php echo $categoria['id_cat']; ?>" />
                                    <input type="submit" name="deletar" value="Selecionar" class="btn btn-warning btn-sm" />
                                </form>
                            </td>
                        </tr>
                        <?php
                      }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>