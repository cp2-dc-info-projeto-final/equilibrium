<?php
    session_start();

    if(isset($_SESSION["logado"])){
        require_once("../funcao/conexao.php");

        $PDO = CriarConexao();

        if(isset($_GET["usuarioRequerido"]) && $_SESSION["tipoUsuario"] == 1) {
            $usuario = $_GET["usuarioRequerido"];
        }else{
            $usuario = $_SESSION["usuario"];
        }

        $sql = "DELETE FROM usuario WHERE usuario = :usuario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(':usuario', $usuario);
        $consulta->execute();

        header("location: ../funcao/logout.php");
    }else{
        header("location: ../inicial/index.php");
    }
?>