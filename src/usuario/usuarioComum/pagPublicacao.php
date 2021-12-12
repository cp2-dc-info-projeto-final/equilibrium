<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("Location: ../../inicial/index.php");
    }

    require_once("../../funcao/conexao.php");

    $usuario = $_SESSION["usuario"];
    $tipoUsuario = $_SESSION["tipoUsuario"];
    $idUsuario = $_SESSION["logado"]; 

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
                    <input type="search" class="form-control" placeholder="Pesquisar usuário..." name="nomeUsuarioPesquisado" aria-label="Search" title="Use apenas alfanuméricos com, no mínimo, três alfanuméricos" pattern="[A-Za-z1-9]{3,}" required>
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
                    <form action="../../post/publicacaoPost.php" method="POST" id="formPublicacao" name="formPublicacao" enctype='multipart/form-data'>
                        <textarea name="descricaoPostagem" form="formPublicacao" rows="7" class="form-control" placeholder="Como está mantendo seu equilíbrio hoje?" maxlength="1750" required></textarea>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-9 col-md-3 col-lg-3">
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
            require_once("../../post/feedPost.php");
            require_once("../../comentario/feedComentario.php");

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
                            <textarea disabled class="form-control" rows="7"><?php echo $posts[$indicePost]["texto"]; ?></textarea>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <?php
                                        $sql = "SELECT count(*) FROM gostei WHERE id_usuario = :idUsuario AND id_post_ou_coment = :idPost AND gostei_de_post_ou_coment = 0";

                                        $consulta = $PDO->prepare($sql);
                                        $consulta->bindParam(":idUsuario", $_SESSION["logado"]);
                                        $consulta->bindParam(":idPost", $posts[$indicePost]["id"]);
                                        $consulta->execute();

                                        $jaGostou = $consulta->fetch(PDO::FETCH_NUM);

                                        if($jaGostou[0] == 0){
                                            ?>
                                            <a href="#" onclick="darGostei(<?php echo $posts[$indicePost]['id']?>, 0)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                </svg>
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="#" onclick="tirarGostei(<?php echo $posts[$indicePost]['id']?>, 0)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                </svg>
                                            </a>
                                            <?php
                                        }
                                    ?>
                                    <b><?php 
                                        $sql = "SELECT Count(*) FROM gostei WHERE id_post_ou_coment = :idPost AND gostei_de_post_ou_coment = 0";
                                        
                                        $consulta = $PDO->prepare($sql);
                                        $consulta->bindParam(":idPost",$posts[$indicePost]["id"]);
                                        $consulta->execute();

                                        $qntGostei = $consulta->fetch(PDO::FETCH_NUM);
                                        
                                        echo $qntGostei[0]." Gostei(s)";
                                    ?></b>
                                </div>
                                <div class="text-end col-sm-6 col-md-6 col-lg-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    <a href="#enviarComentario<?php echo $posts[$indicePost]["id"];?>" class="text-decoration-none" style="color:#1ABC9C"><b>Comentar</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <a href="#" class="d-block link-dark text-decoration-none form-label" style="color:#1ABC9C" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                    <strong><?php echo $_SESSION["usuario"];?></strong>
                                </a>
                                    <div class="row g-3 align-items-center">
                                        
                                            <div class="col-sm-11 col-md-11 col-lg-11">
                                                <form method="POST" action="../../comentario/publicarComentario.php?pagRetorno=pagPublicacao" id="formComentario">
                                                    <textarea name="textoComent" id="enviarComentario<?php echo $posts[$indicePost]["id"];?>" rows="3" class="form-control" placeholder="O que achou do post? Comente!" maxlength="400" required></textarea>
                                            </div>
                                        
                                            <input type="number" name="idPost" value="<?php echo $posts[$indicePost]["id"];?>" hidden>
                                            <div class="col-sm-11 col-md-3 col-lg-3">
                                                <input type="submit" name="btnComentar" class="form-control " value="Comentar" style="background-color:#1ABC9C;color:#FFF;">
                                            </div>
                                        </form>
                                    </div>
                            </div>
                            <?php 
                                $comentarios = listarComentario($PDO, $posts[$indicePost]["id"]);
                                for($indiceComentario = 0; $indiceComentario < count($comentarios); $indiceComentario++) { ?>
                                    <div class="mb-3">
                                        <a href="#" class="d-block link-dark text-decoration-none form-label" style="color:#1ABC9C" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                            <strong>
                                                <?php 
                                                    $sql = "SELECT nome FROM usuario WHERE id = :idUsuario";
                                                    $consulta = $PDO->prepare($sql);
                                                    $consulta->bindParam(":idUsuario", $comentarios[$indiceComentario]["id_usuario"]);
                                                    $consulta->execute();

                                                    $nomeUsuario = $consulta->fetch(PDO::FETCH_ASSOC);
                                            
                                                    echo $nomeUsuario["nome"];
                                                ?>
                                            </strong>
                                        </a>

                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-11 col-lg-11">
                                                <textarea class="form-control" disabled><?php echo $comentarios[$indiceComentario]["texto"];?></textarea>
                                            </div>

                                            <div class="col-1">
                                                <?php if($_SESSION["logado"] == $comentarios[$indiceComentario]["id_usuario"] || $_SESSION["tipoUsuario"] == 1) { ?>
                                                <div class="flex-shrink-0 col-lg-1 col-md-1 col-sm-1">
                                                    <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                                        </svg>
                                                    </a>
                                                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                                        <li><a class="dropdown-item" onclick="excluirComentario(<?php echo $comentarios[$indiceComentario]['id'];?>)" href="#">Excluir comentário</a></li>
                                                        <?php
                                                            if($_SESSION["logado"] == $comentarios[$indiceComentario]["id_usuario"]) { 
                                                        ?>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" onclick="alterarComentario(<?php echo $comentarios[$indiceComentario]['id'];?>)" href="#">Alterar comentário</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <?php }?>
                                            </div>
                                            <input type="number" name="idPost" value="<?php echo $posts[$indicePost]["id"];?>" hidden>
                                            <div class="col-6">
                                                <?php
                                                    $sql = "SELECT count(*) FROM gostei WHERE id_usuario = :idUsuario AND id_post_ou_coment = :idComentario AND gostei_de_post_ou_coment = 1";

                                                    $consulta = $PDO->prepare($sql);
                                                    $consulta->bindParam(":idUsuario", $_SESSION["logado"]);
                                                    $consulta->bindParam(":idComentario", $comentarios[$indiceComentario]["id"]);
                                                    $consulta->execute();

                                                    $jaGostou = $consulta->fetch(PDO::FETCH_NUM);

                                                    if($jaGostou[0] == 0){
                                                ?>
                                                <a href="#" onclick="darGostei(<?php echo $comentarios[$indiceComentario]['id']; ?>, 1)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                    </svg>
                                                </a>
                                                <?php }else{ ?>
                                                <a href="#" onclick="tirarGostei(<?php echo $comentarios[$indiceComentario]['id']; ?>, 1)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#1ABC9C" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                    </svg>
                                                </a>
                                            <?php
                                        }
                                    ?>
                                                <b><?php 
                                                        $sql = "SELECT Count(*) FROM gostei WHERE id_post_ou_coment = :idComentario AND gostei_de_post_ou_coment = 1";
                                        
                                                        $consulta = $PDO->prepare($sql);
                                                        $consulta->bindParam(":idComentario",$comentarios[$indiceComentario]["id"]);
                                                        $consulta->execute();

                                                        $qntGostei = $consulta->fetch(PDO::FETCH_NUM);
                                                        
                                                        echo $qntGostei[0]." Gostei(s)";
                                                ?></b>
                                            </div>
                                        </div>

                                    </div>
                                <?php
                                }
                            ?>
                        </div>
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

        function excluirComentario(idComentario){
            if(confirm("Você realmente deseja fazer isto?")){
                window.location.replace("../../comentario/excluirComentario.php?idComentario="+idComentario);
            }
        }

        function alterarComentario(idComentario) {
            if(confirm("Você realmente deseja fazer isto?")){
                window.location.replace("../../comentario/pagAlterarComentario.php?idComentario="+idComentario);
            }
        }

        function darGostei(idPostOuComent, gostei_de_post_ou_coment) {
            window.location.replace("darGostei.php?idPostOuComent="+idPostOuComent+"&gostei_de_post_ou_coment="+gostei_de_post_ou_coment+"&pagRetorno=pagPublicacao");
        }

        function tirarGostei(idPostOuComent, gostei_de_post_ou_coment) {
            window.location.replace("tirarGostei.php?idPostOuComent="+idPostOuComent+"&gostei_de_post_ou_coment="+gostei_de_post_ou_coment+"&pagRetorno=pagPublicacao");
        }
    </script>
</body>
</html>