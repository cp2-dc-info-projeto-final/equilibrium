<?php
    session_start();

    if(isset($_POST["btnAlterarSenha"])){
        require_once("../../funcao/conexao.php");
        require_once("../../funcao/validacao.php");
        
        $PDO = CriarConexao();
        
        $usuarioRequerido = $_GET["usuarioRequerido"];
        
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

        $CmdSQL = "UPDATE usuario SET senha = :senha WHERE usuario = :usuarioRequerido";
        $Resultado = $PDO->prepare($CmdSQL);
        $Resultado->bindParam(':senha',$senha);
        $Resultado->bindParam(":usuarioRequerido",$usuarioRequerido);
        $Resultado->execute();

        if ($_SESSION["tipoUsuario"] == 1) {
            header("location: pagAlterarPerfil.php?msgSucessoAlteracaoSenha=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Alteração feita com sucesso!</li>")."&usuarioRequerido=".$nomeUsuario);
            exit();
        }
        
        header("location: pagAlterarPerfil.php?msgSucessoAlteracaoSenha=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Senha alterada com sucesso!</li>"));
    }else{
        header("location: ../../inicial/index.php");
    }
?>