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
          <a class="nav-link active" aria-current="page" href="invertario.html">
            <button type="button" class="btn btn-light">Inventário</button>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teladealerta.html">
            <button type="button" class="btn btn-light position-relative">
                Alertas
                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">Controle</span>
                </span>
            </button>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teladerelatorio.html">
            <button type="button" class="btn btn-light">Relatório</button>
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

  </nav>

  <<div class="container mt-5">
    <?php

    try {
        $conn = new PDO("mysql:host=localhost;dbname=projeto", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
    echo "<h2>Filtro</h2>";
    echo '<ul class="list-group">';

    $query = "SELECT id_cat, nome_cat FROM categoria";
    $stmt = $conn->query($query); 

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            echo '<li class="list-group-item">
                    <a href="?id_cat=' . $row['id_cat'] . '" class="list-group-item-action">' . $row['nome_cat'] . '</a>
                  </li>';
        }
    } else {
        echo "<li class='list-group-item'>Nenhuma categoria encontrada.</li>";
    }

    echo '</ul>';

    $id_cat = isset($_GET['id_cat']) ? intval($_GET['id_cat']) : 0;

    echo "<h2>Produtos:</h2>";

    if ($id_cat > 0) {
        $query = "SELECT nome_prod FROM produto WHERE id_cat = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id_cat, PDO::PARAM_INT); 
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<p>" . $row['nome_prod'] . "</p>";
            }
        } else {
            echo "<p>Nenhum produto encontrado nesta categoria.</p>";
        }
    } else {
        echo "<p>Selecione uma categoria para ver os produtos.</p>";
    }
    $conn = null;
    ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>