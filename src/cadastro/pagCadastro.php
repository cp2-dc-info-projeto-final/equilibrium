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
        <link rel="stylesheet" href="../css/styleGeneral.css">
    </head>
    <body>
        <div class="container text-center">
            <div class="row"><div class="col-lg-12"><img src="../imagens/logo_completa.png" alt="logo completa" class="img-fluid" height="128" width="512"></div></div>
                <div class="row">
                    <div class="container col-lg-4 shadow-sm rounded" style="background-color:white">
                        <h2>Cadastro</h2>
                        <p>É rápido e fácil.</p>
                        <hr style="color:black;">
                        <?php if(isset($_GET["listaErroCadastro"])){
                            echo "<p>".$_GET["listaErroCadastro"]."</p>";
                        }elseif(isset($_GET["msgSucesso"])){
                            echo "<p>".$_GET["msgSucesso"]."</p>";
                        }?>
                        <form action="cadastro.php" method="post" class="form">
                            <input type="text" name="nomeCadastro" placeholder="Nome" class="form-control" required><br>
                            <input type="text" name="usuarioCadastro" placeholder="Nome de usuário" title="Use apenas letras minúsculas e números" class="form-control" required pattern="[a-z0-9]{1,25}"><br>
                            <input type="email" name="emailCadastro" placeholder="Email" class="form-control" required><br>
                            <input type="password" name="passwordCadastro" placeholder="Senha" class="form-control" required><br>
                            <input type="password" name="confirmPasswordCadastro" placeholder="Confirmar senha" class="form-control" required><br>
                            <input type="submit" onclick="mudarCorFundoBotao(this)" value="Cadastrar" class="form-control styleButton" name="btnCadastrar">
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="container col-lg-4 shadow-sm rounded" style="background-color:white"><p>Já possui uma conta? <a href="../inicial/index.php">Logar</a></p></div>
                </div>
            </div>
        </div>
        
        <script src="../funcao/mudarCorFundo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>