<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <title>Document</title>
    <?php include "conn.php"; ?>
    <link rel="stylesheet" href="teladelogin.css">
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
    <link rel="stylesheet" href="teladelogin.css">
</head>
<body>
    <nav class="navbar">
        <div class="containerPP">
          <a class="navbar-brand" href="#">
            <img src="PEILOGO.png" alt="Bootstrap" width="35%" height="100%">
          </a>
        </div>
      </nav>

        <form action="teladelogin.php" method="post">
                <div class="caixacentral">
                    <div class="form-floating mb-3">
                    <input type="text" name="login" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Login</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Senha</label>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit" name="entrar" value="logar">Entrar</button>
            </div>
        </form>

            <?php
            if(isset($_POST['entrar'])){
                $login=$_POST['login'];
                $senha=md5($_POST['senha']);
                $conslog=$conn->prepare("SELECT * FROM `login` 
                WHERE `log_usu` = :login AND `log_senha` = :senha 
                AND `log_status` = 1");
                $conslog->bindValue(":login",$login);
                $conslog->bindValue(":senha",$senha);
                $conslog->execute();
                if($conslog->rowCount()==0){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Login ou senha inválido!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }else{
                    $row=$conslog->fetch();
                    session_start();
                    $_SESSION['login']=$row['log_id'];
                    $_SESSION['tipo']=$row['log_tipo'];
                    header('location:invertario.php');
                }
            }
        ?>



</body>
</html>