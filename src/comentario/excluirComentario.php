<?php
    session_start();

    if(!isset($_SESSION["logado"])){
        header("Location: ../inicial/index.php");
        exit();
    }

    require_once("../funcao/conexao.php");

    $PDO = CriarConexao();

    $idComentario = $_GET["idComentario"];

    if($_SESSION["tipoUsuario"] != 1){
        $sql = "SELECT id_usuario FROM comentario WHERE id = :idComentario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":idComentario",$idComentario);
        $consulta->execute();

        $idUsuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if($idUsuario["id_usuario"] != $_SESSION["logado"]){
            header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            exit();
        }

        unset($idUsuario);
    }


    $sql = "DELETE FROM comentario WHERE id = :idComentario";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idComentario", $idComentario);
    $consulta->execute();

    if($_GET["pagRetorno"] == "pagPesquisaUsuario"){
        header("Location: ../usuario/usuarioComum/pagPesquisaUsuario.php?nomeUsuarioPesquisado=".urlencode($_GET["nomeUsuarioPesquisado"]));
    }else{
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
    }
    
    exit();
?>