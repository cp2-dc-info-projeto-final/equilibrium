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
                <a href="pagPublicacao.php" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none" id="dropdownNavLink" aria-expanded="false">
                    <img src="../../imagens/logo_completa.png" height="64" width="256">
                </a>
                <div class="d-flex align-items-center">
                    <form class="w-100 me-3" name="formPesquisaUsuario" action="?" method="GET">
                        <input type="search" class="form-control" placeholder="Pesquisar usuário..." name="nomeUsuarioPesquisado" aria-label="Search" title="Use apenas alfanuméricos com, no mínimo, três alfanuméricos" pattern="[A-Za-z1-9]{3,}">
                    </form>

                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            <strong><?php echo $_SESSION["usuario"];?></strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="pagPublicacao.php">Página inicial</a></li>
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
            <div class="container">
                <?php
                    require_once("../../post/feed.php");
                
                    $sql = "SELECT id, nome, usuario FROM usuario WHERE usuario LIKE :keyword";
                    $consulta = $PDO->prepare($sql);
                    $consulta->bindValue(":keyword", "%".$_GET["nomeUsuarioPesquisado"]."%", PDO::PARAM_STR);
                    $consulta->execute();
            
                    $usuariosAchados = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    for($indiceUser = 0; $indiceUser < count($usuariosAchados); $indiceUser++) {
                ?>
                <div class="container col-lg-6 col-md-6 col-sm-6">
                    <div class="card rounded container">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1">
                                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="#" style="color: #1ABC9C" class="d-block link-dark text-decoration-none" aria-expanded="false">
                                        <strong><?php echo $usuariosAchados[$indiceUser]["nome"];?></strong>
                                        <p><?php echo "@".$usuariosAchados[$indiceUser]["usuario"];?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><br>

                    <?php
                        require_once("../../post/feed.php");

                        $posts = listarPost($PDO,$usuariosAchados[$indiceUser]["id"]);
                    
                        for($indicePost = 0; $indicePost < count($posts); $indicePost++) {
                    ?>
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
                                        <?php   
                                            if($_SESSION["logado"] == $usuariosAchados[$indicePost]["id"] || $_SESSION["tipoUsuario"] == 1) {
                                        ?>
                                        <li><a class="dropdown-item" onclick="excluirPostagem(<?php echo $posts[$indicePost]['id'];?>)" href="#">Excluir postagem</a></li>
                                        <?php
                                            if($_SESSION["logado"] == $usuariosAchados[$indicePost]["id"]) { 
                                        ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" onclick="alterarPostagem(<?php echo $posts[$indicePost]['id'];?>)" href="#">Alterar postagem</a></li>
                                        <?php } }?>
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
                    </div> <br>

                    <?php }?>
                </div> 

                <?php }?>
            </div>
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