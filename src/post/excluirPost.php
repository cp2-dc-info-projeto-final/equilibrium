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


    $sql = "DELETE FROM posts WHERE id = :idPostagem";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idPostagem", $idPostagem);
    $consulta->execute();

    header("Location: ../usuario/usuarioComum/pagPublicacao.php");
?>