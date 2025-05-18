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
session_start(); 
if (isset($_POST['id_cat']) && isset($_POST['deletar'])) {
    $id_cat = $_POST['id_cat']; 
    
    try {
        $deleteCategoria = $conn->prepare("DELETE FROM categoria WHERE id_cat = :id_cat");
        $deleteCategoria->bindValue(":id_cat", $id_cat);
        $deleteCategoria->execute();

        $_SESSION['message'] = 'Categoria excluída com sucesso!';
        header('Location: tabeladedeletcat.php');
        exit();
    } catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>

<div class="bemvindo"><h2>Excluir categoria</h2></div>

<?php
if (isset($_GET['id_cat'])) {
    $id_cat = $_GET['id_cat']; 
    $query = $conn->prepare("SELECT nome_cat FROM categoria WHERE id_cat = :id_cat");
    $query->bindValue(":id_cat", $id_cat);
    $query->execute();
    $categoria = $query->fetch();

    if ($categoria) {
        if (isset($_POST['excluir'])) {
            try {
                $delete = $conn->prepare("DELETE FROM categoria WHERE id_cat = :id_cat");
                $delete->bindValue(":id_cat", $id_cat);
                $delete->execute();

                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Categoria excluída com sucesso!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                echo '<a href="tabeladedeletecat.php" class="btn btn-secondary">Voltar para a Tabela</a>';
                exit();
            } catch (Exception $e) {
                echo '<div class="alert alert-danger">Erro ao excluir a categoria: ' . $e->getMessage() . '</div>';
            }
        }
        ?>
        <div class="centro">
            <div class="caixa">
                <div class="row">
                    <h2>Excluir Categoria</h2>
                    <form action="teladedeletecat.php?id_cat=<?php echo $id_cat; ?>" method="POST">
                        <input type="hidden" name="id_cat" value="<?php echo $id_cat; ?>" />
                        
                        <div class="mb-3">
                            <label for="nome_categoria" class="form-label">Nome da Categoria</label>
                            <input type="text" name="nome_categoria" id="nome_categoria" class="form-control" 
                                   value="<?php echo htmlspecialchars($categoria['nome_cat']); ?>" readonly />
                        </div>
                        <input type="submit" name="excluir" value="Excluir categoria" class="btn btn-danger" />
                        <a href="tabeladedeletcat.php" class="btn btn-secondary">Voltar para a Tabela</a>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "<div class='alert alert-danger'>Categoria não encontrada.</div>";
    }
    } else {
        echo "<div class='alert alert-danger'>ID da categoria não especificado.</div>";
    }
    ?>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>