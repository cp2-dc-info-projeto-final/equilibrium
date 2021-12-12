<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("Location: ../inicial/index.php");
        exit();
    }

    require_once("../funcao/conexao.php");

    $usuario = $_SESSION["usuario"];
    $tipoUsuario = $_SESSION["tipoUsuario"];

    $PDO = CriarConexao();

    $idComentario = $_GET["idComentario"];

    $sql = "SELECT id_usuario, id_post, texto, dt_comentario FROM comentario WHERE id = :idComentario";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idComentario",$idComentario);
    $consulta->execute();

    $dadosComentario = $consulta->fetch(PDO::FETCH_ASSOC);

    if($_SESSION["tipoUsuario"] != 1 && $dadosComentario["id_usuario"] != $_SESSION["logado"]){
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
        exit();
    }

    $sql = "SELECT nome FROM usuario WHERE usuario = :usuario";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":usuario",$usuario);
    $consulta->execute();

    $nome = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equilibrium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../css/styleGeneral.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            margin-top:15px;
            padding-bottom:15px;
            padding-top:20px;
        }
    </style>
</head>
<body>
    <header class="py-3 mb-3 border-bottom shadow-sm" style="background-color:white;">
        <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
            <a href="../usuario/usuarioComum/pagPublicacao.php" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none" id="dropdownNavLink" aria-expanded="false">
                <img src="../imagens/logo_completa.png" height="64" width="256">
            </a>
            <div class="d-flex align-items-center">
                <form class="w-100 me-3">
                    <input type="search" class="form-control" placeholder="Pesquisar usuário..." aria-label="Search">
                </form>

                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <strong><?php echo $_SESSION["usuario"];?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="pagAlterarPerfil.php">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../funcao/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="container col-lg-6 col-md-6 col-sm-6 rounded">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="#" class="d-block link-dark text-decoration-none form-label" style="color:#1ABC9C" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            <strong><?php echo $_SESSION["usuario"];?></strong>
                        </a>
                        <div class="row g-3 align-items-center">        
                            <div class="col-11">
                                <form method="POST" action="alterarComentario.php" id="formComentario">
                                    <textarea name="textoComentAlterado" rows="3" class="form-control" placeholder="O que achou do post? Comente!" maxlength="400" required><?php echo $dadosComentario["texto"]; ?></textarea>
                            </div>
                                        
                                <input type="number" name="idComentario" value="<?php echo $idComentario; ?>" hidden>
                                <div class="col-3">
                                    <input type="submit" name="btnAlterarComentario" class="form-control" value="Comentar" style="background-color:#1ABC9C;color:#FFF;">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>