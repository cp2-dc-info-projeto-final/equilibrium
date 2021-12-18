<?php 
    session_start();
    require_once("../../funcao/conexao.php");

    $PDO = CriarConexao();

    $tipoUsuario = $_SESSION["tipoUsuario"];

    if($tipoUsuario != 1) {
        header("location: ../../inicial/index.php");
        exit();
    }

    $idUsuarioRequerido = $_POST["idUsuarioEdicao"];

    if(isset($_POST["btnConcederPermissao"])){
        $sql = "UPDATE usuario SET admin = 1 WHERE id = :idUsuarioRequerido";
    }elseif(isset($_POST["btnRetirarPermissao"])){
        $sql = "UPDATE usuario SET admin = 0 WHERE id = :idUsuarioRequerido";
    }elseif(isset($_POST["btnExcluirUsuario"])){
        header("location: ../exclusaoUsuario.php?idUsuarioRequerido=".$idUsuarioRequerido);
        exit();
    }elseif(isset($_POST["btnEditarUsuario"])){
        header("location: ../usuarioComum/pagAlterarPerfil.php?idUsuarioRequerido=".$idUsuarioRequerido);
        exit();
    }

    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(':idUsuarioRequerido',$idUsuarioRequerido);
    $consulta->execute();

    header("location: pagAdmin.php");
    exit();
?>