<?php
    session_start();

    if(isset($_POST["btnSalvarPerfil"])){
        require_once("../../funcao/conexao.php");
        require_once("../../funcao/validacao.php");

        $PDO = CriarConexao();
        
        $usuarioRequerido = $_GET["usuarioRequerido"];
        
        $ListaErro = "";

        $NomeCompleto = $_POST["nomeAlteracaoPerfil"];

        $nomeUsuario = $_POST["usuarioAlteracaoPerfil"];
        if($nomeUsuario != $usuarioRequerido){
            if(ehMesmoNomeUsuario($nomeUsuario, $PDO) > 0){
                $ListaErro = "<li style='color:red;list-style-type:none;'>Nome de usuário já existente</li>";
                header("location: pagAlterarPerfil.php?usuarioRequerido=".$usuarioRequerido."&listaErroAlteracaoPerfil=".urlencode($ListaErro));
                exit();
            }
        }

        $CmdSQL = "SELECT email FROM usuario WHERE usuario = :usuario";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(":usuario", $usuarioRequerido);
        $Prepare->execute();
        
        $emailExistente = $Prepare->fetch(PDO::FETCH_ASSOC);

        $email = $_POST["emailAlteracaoPerfil"];
        if($emailExistente["email"] != $email){
            if(EhMesmoEmail($email, $PDO) > 0){
                $ListaErro = "<li style='color:red;list-style-type:none;'>Email já existente</li>";
                header("location: pagAlterarPerfil.php?usuarioRequerido=".$usuarioRequerido."&listaErroAlteracaoPerfil=".urlencode($ListaErro));
                exit();
            }
        }
        unset($emailExistente);

        $Senha = $_POST["passwordAlteracaoPerfil"];
        $ConfirmaSenha = $_POST["confirmPasswordAlteracaoPerfil"];

        if($Senha === $ConfirmaSenha):
            $Senha = password_hash($Senha, PASSWORD_DEFAULT);
        else:
            $ListaErro = "<li style='color:red;list-style-type:none;'>As senhas não coincidem</li>";
            header("location: pagAlterarPerfil.php?usuarioRequerido=".$usuarioRequerido."&listaErroAlteracaoPerfil=".urlencode($ListaErro));
            exit();
        endif;

        $CmdSQL = "UPDATE usuario SET nome = :nomeCompleto, usuario = :nomeUsuario, email = :email, senha = :senha WHERE usuario = :usuario";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(':nomeCompleto',$NomeCompleto);
        $Prepare->bindParam(':email',$email);
        $Prepare->bindParam(':senha',$Senha);
        $Prepare->bindParam(':nomeUsuario',$nomeUsuario);
        $Prepare->bindParam(":usuario", $usuarioRequerido);

        $Resultado = $Prepare->execute();

        if(isset($_GET["usuarioRequerido"]) && $_SESSION["tipoUsuario"] == 1 && $_SESSION["usuario"] != $nomeUsuario){
            header("location: ../admin/pagAdmin.php?msgSucesso=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Cadastro feito com sucesso!</li>"));
        }
        elseif($nomeUsuario != $usuarioRequerido){
            header("location: ../../funcao/logout.php");
        }else{
            header("location: pagAlterarPerfil?mgsSucesso=");
        }
    }
?>