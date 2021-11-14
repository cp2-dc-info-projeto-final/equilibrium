<?php 
    session_start();
    require_once("../../funcao/conexao.php");

    $PDO = CriarConexao();

    $tipoUsuario = $_SESSION["tipoUsuario"];

    if($tipoUsuario != 1) {
        header("location: ../../inicial/index.php");
        exit();
    }

    $usuarioRequerido = $_POST["usuarioEdicao"];

    if(isset($_POST["btnConcederPermissao"])){
        $sql = "UPDATE usuario SET admin = 1 WHERE usuario = :usuario";
    }elseif(isset($_POST["btnRetirarPermissao"])){
        $sql = "UPDATE usuario SET admin = 0 WHERE usuario = :usuario";
    }elseif(isset($_POST["btnExcluirUsuario"])){
        header("location: ../exclusaoUsuario.php?usuarioRequerido=".$usuarioRequerido);
        exit();
    }elseif(isset($_POST["btnEditarUsuario"])){
        header("location: ../usuarioComum/pagAlterarPerfil.php?usuarioRequerido=".$usuarioRequerido);
        exit();
    }

    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(':usuario',$usuarioRequerido);
    $consulta->execute();

    header("location: pagAdmin.php");
    exit();
?>