<?php
    if (isset($_POST['btnAlterarComentario'])) {
        require_once("../funcao/conexao.php");

        session_start();

        $PDO = CriarConexao();

        $idUsuario = $_SESSION["logado"];
        $idComentario = $_POST["idComentario"];
        $dtPublicacao = date("Y-m-d");
        $texto = $_POST["textoComentAlterado"];


        $sql = "UPDATE comentario SET texto = :texto, dt_comentario = :dtPublicacao WHERE id_usuario = :id_usuario AND id = :idComentario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":id_usuario", $idUsuario);
        $consulta->bindParam(":texto", $texto);
        $consulta->bindParam(":dtPublicacao", $dtPublicacao);
        $consulta->bindParam(":idComentario", $idComentario);
        $consulta->execute();
            
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
    }else{
        
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
    }

    exit();
?>