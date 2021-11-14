<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("Location: ../../inicial/index.php");
    }

    require_once("../../funcao/conexao.php");

    if(isset($_GET["usuarioRequerido"]) && $_SESSION["tipoUsuario"] == 1) {
        $usuario = $_GET["usuarioRequerido"];
    }else{
        $usuario = $_SESSION["usuario"];
    }

    $PDO = CriarConexao();

    $sql = "SELECT nome, admin, email FROM usuario WHERE usuario = :usuario";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":usuario",$usuario);
    $consulta->execute();

    $dadosUsuario = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["usuario"];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../../css/styleGeneral.css">
</head>
<body>
    <header class="py-3 mb-3 border-bottom shadow-sm" style="background-color:white;">
        <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
            <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none" id="dropdownNavLink" aria-expanded="false">
                <img src="../../imagens/logo_completa.png" height="64" width="256">
            </a>
            <div class="d-flex align-items-center">
                <form class="w-100 me-3" name="formPesquisaUsuario" action="pagPesquisaUsuario.php" method="GET">
                    <input type="search" class="form-control" placeholder="Pesquisar usuário..." name="nomeUsuarioPesquisado" aria-label="Search" title="Use apenas alfanuméricos com, no mínimo, três alfanuméricos" pattern="[A-Za-z1-9]{3,}">
                </form>

                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <strong><?php echo $_SESSION["usuario"];?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="pagPublicacao.php">Página inicial</a></li>
                        <?php if($_SESSION["tipoUsuario"] == 1){
                                echo "<li><hr class='dropdown-divider'></li>";
                                echo "<li><a class='dropdown-item' href='../admin/pagAdmin.php'>Página administrador</a></li>";
                            }
                        ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../funcao/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="main">
        <div class="container text-center">
                <div class="row">
                    <div class="container col-lg-4 shadow-sm rounded" style="background-color:white">
                        <h2>Alterar perfil</h2>
                        <p>Equilibrium. O lugar de perfeito equilíbrio.</p>
                        <hr style="color:black;">
                        <?php if(isset($_GET["listaErroAlteracaoPerfil"])){
                            echo "<p>".$_GET["listaErroAlteracaoPerfil"]."</p>";
                        }elseif(isset($_GET["msgSucesso"])){
                            echo "<p>".$_GET["msgSucesso"]."</p>";
                        }?>
                        <form action="alterarPerfil.php?usuarioRequerido=<?php echo $usuario;?>" method="post" class="form">
                            <input type="text" name="nomeAlteracaoPerfil" value="<?php echo $dadosUsuario["nome"];?>" placeholder="Nome" class="form-control" required><br>
                            <input type="text" name="usuarioAlteracaoPerfil" value="<?php echo $usuario;?>" placeholder="Nome de usuário" title="Use apenas letras minúsculas e números" class="form-control" required pattern="[a-z0-9]{1,25}"><br>
                            <input type="email" name="emailAlteracaoPerfil" value="<?php echo $dadosUsuario["email"];?>" placeholder="Email" class="form-control" required><br>
                            <input type="password" name="passwordAlteracaoPerfil" placeholder="Nova senha" class="form-control" required><br>
                            <input type="password" name="confirmPasswordAlteracaoPerfil" placeholder="Confirmar nova senha" class="form-control" required><br>
                            <input type="submit" onclick="mudarCorFundoBotao(this)" value="Salvar" class="form-control styleButton" name="btnSalvarPerfil">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer></footer>
    <script src="../../funcao/mudarCorFundo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>