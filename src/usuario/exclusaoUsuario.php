<?php
    session_start();

    if(isset($_SESSION["logado"])){
        require_once("../funcao/conexao.php");

        $PDO = CriarConexao();

        if(isset($_GET["idUsuarioRequerido"]) && $_SESSION["tipoUsuario"] == 1) {
            $idUsuarioRequerido = $_GET["idUsuarioRequerido"];
        }else{
            $idUsuarioRequerido = $_SESSION["logado"];
        }

        $sql = "DELETE FROM posts WHERE id_usuario = :id_usuario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(':id_usuario', $idUsuarioRequerido);
        $consulta->execute();

        $sql = "DELETE FROM comentario WHERE id_usuario = :id_usuario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(':id_usuario', $idUsuarioRequerido);
        $consulta->execute();

        $sql = "DELETE FROM gostei WHERE id_usuario = :id_usuario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":id_usuario", $idUsuarioRequerido);
        $consulta->execute();

        $sql = "DELETE FROM usuario WHERE id = :idUsuarioRequerido";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(':idUsuarioRequerido', $idUsuarioRequerido);
        $consulta->execute();

        header("location: admin/pagAdmin.php");
    }else{
        header("location: ../inicial/index.php");
    }
?>