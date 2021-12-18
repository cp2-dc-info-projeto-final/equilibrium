<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("Location: ../inicial/index.php");
        exit();
    }
    require_once("../funcao/conexao.php");

    $PDO = CriarConexao();

    $idPostagem = $_GET["idPostagem"];

    if($_SESSION["tipoUsuario"] != 1){
        $sql = "SELECT id_usuario FROM posts WHERE id = :idPostagem";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":idPostagem",$idPostagem);
        $consulta->execute();

        $idUsuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if($idUsuario["id_usuario"] != $_SESSION["logado"]){
            header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            exit();
        }

        unset($idUsuario);
    }

    $sql = "SELECT nome_img FROM posts WHERE id = :idPostagem";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idPostagem", $idPostagem);
    $consulta->execute();

    $imgName = $consulta->fetch(PDO::FETCH_ASSOC);

    unlink("../imagens/post/".$imgName["nome_img"]);

    $sql = "DELETE FROM gostei WHERE (id_post_ou_coment = :idPostagem AND gostei_de_post_ou_coment = 0) OR (id_post_ou_coment = (SELECT id FROM comentario WHERE id_post = :idPostagem) AND gostei_de_post_ou_coment = 1)";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idPostagem", $idPostagem);
    $consulta->execute();

    $sql = "DELETE FROM comentario WHERE id_post = :idPostagem";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idPostagem", $idPostagem);
    $consulta->execute();

    $sql = "DELETE FROM posts WHERE id = :idPostagem";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idPostagem", $idPostagem);
    $consulta->execute();

    if($_GET["pagRetorno"] == "pagPesquisaUsuario"){
        header("Location: ../usuario/usuarioComum/pagPesquisaUsuario.php?nomeUsuarioPesquisado=".urlencode($_GET["nomeUsuarioPesquisado"]));
    }else{
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
    }
    exit();
?>