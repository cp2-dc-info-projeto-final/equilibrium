<?php
    session_start();

    if(isset($_SESSION["logado"])){
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Equilibrium</title>
        <link rel="stylesheet" href="../css/styleIndex.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            body {
            background-color: #f0f2f5;
            }
            .container {
                margin-top:15px;
                padding-bottom:15px;
                padding-top:20px;
                color:#1ABC9C;
            }
        </style>
    </head>
    <body>
        <div class="container text-center">
            <div class="row"><div class="col-lg-12"><img src="../imagens/logo_completa.png" alt="logo completa" class="img-fluid" height="128" width="512"></div></div>
                <div class="row">
                    <div class="container col-lg-4 shadow-sm rounded" style="background-color:white">
                        <h2>Login</h2><hr style="color:black;">
                        <form action="../login/login.php" method="post">
                            <input type="text" name="emailOuUsuarioLogin" placeholder="Email ou nome de usuário" class="form-control" required><br>
                            <input type="password" name="passwordLogin" placeholder="Senha" class="form-control" required><br>
                            <input type="submit" value="Entrar" style="background-color:#1ABC9C;color:white;" class="form-control" name="btnLogar">
                        </form><br><hr style="color:black;">
                        <a href="">Esqueceu a senha?</a>
                    </div>
                </div>
                <div class="row">
                    <div class="container col-lg-4 shadow-sm rounded" style="background-color:white"><p>Não tem uma conta? <a href="../cadastro/pagCadastro.php">Cadastrar</a></p></div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>