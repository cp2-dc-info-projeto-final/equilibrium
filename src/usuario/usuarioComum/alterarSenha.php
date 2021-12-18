<?php
    session_start();

    if(isset($_POST["btnAlterarSenha"])){
        require_once("../../funcao/conexao.php");
        require_once("../../funcao/validacao.php");
        
        $PDO = CriarConexao();
        
        $idUsuarioRequerido = $_GET["idUsuarioRequerido"];
        
        $ListaErro = "";

        $senha = $_POST["passwordAlteracaoSenha"];
        $ConfirmaSenha = $_POST["confirmPasswordAlteracaoSenha"];

        if($senha === $ConfirmaSenha):
            $senha = password_hash($senha, PASSWORD_DEFAULT);
        else:
            $ListaErro .= "<li style='color:#1ABC9C;list-style-type:none;'>As senhas não coincidem</li>";
            header("location: pagAlterarPerfil.php?listaErroAlteracaoSenha=".urlencode($ListaErro));
            exit();
        endif;

        $CmdSQL = "UPDATE usuario SET senha = :senha WHERE id = :idUsuarioRequerido";
        $Resultado = $PDO->prepare($CmdSQL);
        $Resultado->bindParam(':senha',$senha);
        $Resultado->bindParam(":idUsuarioRequerido",$idUsuarioRequerido);
        $Resultado->execute();

        if ($_SESSION["tipoUsuario"] == 1) {
            header("location: pagAlterarPerfil.php?msgSucessoAlteracaoSenha=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Alteração feita com sucesso!</li>")."&idUsuarioRequerido=".$idUsuarioRequerido);
            exit();
        }
        
        header("location: pagAlterarPerfil.php?msgSucessoAlteracaoSenha=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Senha alterada com sucesso!</li>"));
    }else{
        header("location: ../../inicial/index.php");
    }
?>