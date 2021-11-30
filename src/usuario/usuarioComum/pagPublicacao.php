<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("Location: ../../inicial/index.php");
    }

    require_once("../../funcao/conexao.php");

    $usuario = $_SESSION["usuario"];
    $tipoUsuario = $_SESSION["tipoUsuario"];

    $PDO = CriarConexao();

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
                        <li><a class="dropdown-item" href="pagAlterarPerfil.php">Perfil</a></li>
                        <?php if($tipoUsuario == 1){
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
    <div class="container col-lg-6 col-md-6 col-sm-6 rounded">
            <img src="" alt="imagem do post" class="card-img-top" id="imgPreviewPost" hidden>
            <div class="card">
                <div class="card-body">
                    <form action="../../post/publicacaoPost.php" method="POST" id="formPublicacao" name="formPublicacao" enctype="multipart/form-data">
                        <textarea name="descricaoPostagem" form="formPublicacao" rows="7" class="form-control" placeholder="O que está esperando para mudar o mundo?" maxlength="1000" style="resize: none;" required></textarea>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="file" name="imgPostName" accept="image/*" id="imgPostId" hidden>
                                <input type="submit" value="Publicar" name="btnPublicar" class="form-control" style="background-color:#1ABC9C;color:#FFF;">
                            </form>
                        </div>
                        <div class="text-end col-sm-9 col-md-9 col-lg-9">
                            <label for="imgPostId">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16" style="color:#1ABC9C;">
                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            require_once("../../post/feed.php");

            $posts = listarPost($PDO,$_SESSION["logado"]);

            for($indicePost = 0;$indicePost < count($posts);$indicePost++){
                ?>
                <div class="container col-lg-6 col-md-6 col-sm-6 rounded">
                    <div class="card">
                        <?php
                            if(isset($posts[$indicePost]["nome_img"])){
                                ?><img src="../../imagens/post/<?php echo $posts[$indicePost]["nome_img"] ?>" alt="imagem do post" class="card-img-top"><?php
                            }
                        ?>
                        <div class="card-header">
                            <div class="row">
                                <div class="flex-shrink-0 col-lg-6 col-md-5 col-sm-5">
                                    <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                        <li><a class="dropdown-item" onclick="alterarPostagem(<?php echo $posts[$indicePost]['id'];?>)" href="#">Alterar postagem</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" onclick="excluirPostagem(<?php echo $posts[$indicePost]['id'];?>)" href="#">Excluir postagem</a></li>
                                    </ul>
                                </div>
                                <div class="text-end col-lg-6 col-md-5 col-sm-5">
                                    <p style="color:#1ABC9C;"><span><?php echo $nome["nome"];?></span><strong><?php
                                        if($posts[$indicePost]["alterado"]){
                                            echo " - ".$posts[$indicePost]["dt_postagem"]." - alterado";
                                        }else{
                                            echo " - ".$posts[$indicePost]["dt_postagem"];
                                        }
                                    ?></strong></p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <textarea disabled class="form-control" rows="7" style="resize: none;background-color:#FFF;"><?php echo $posts[$indicePost]["texto"]; ?></textarea>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                
                <?php
            }
        ?>
    </div>
    

    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function excluirPostagem(idPostagem){
            if(confirm("Você realmente deseja fazer isto?")){
                window.location.replace("../../post/excluirPost.php?idPostagem="+idPostagem);
            }
        }

        function alterarPostagem(idPostagem){
            if(confirm("Você realmente deseja fazer isto?")){
                window.location.replace("../../post/pagAlterarPost.php?idPostagem="+idPostagem);
            }
        }
    </script>
</body>
</html>