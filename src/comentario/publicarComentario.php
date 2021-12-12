<?php
    if(isset($_POST["btnComentar"])){
        require_once("../funcao/conexao.php");

        session_start();

        $PDO = CriarConexao();

        $texto = $_POST["textoComent"];

        $idUsuario = $_SESSION["logado"];

        $idPost = $_POST["idPost"];         

        $dtPublicacao = date("Y-m-d");

        $sql = "INSERT INTO comentario(id_usuario,texto,dt_comentario,id_post) VALUES (:idUsuario, :texto, :dtComentario,:idPost)";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":idUsuario",$idUsuario);
        $consulta->bindParam(":texto",$texto);
        $consulta->bindParam(":dtComentario",$dtPublicacao);
        $consulta->bindParam(":idPost", $idPost);
        $consulta->execute();

        if($_GET["pagRetorno"] == "pagPesquisaUsuario"){
            header("Location: ../usuario/usuarioComum/pagPesquisaUsuario.php?nomeUsuarioPesquisado=".urlencode($_GET["nomeUsuarioPesquisado"]));
        }else{
            header("Location: ../usuario/usuarioComum/pagPublicacao.php");
        }

        exit();
    }
?>