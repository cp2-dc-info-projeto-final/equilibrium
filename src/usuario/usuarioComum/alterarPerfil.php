<?php
    session_start();

    if(isset($_POST["btnSalvarPerfil"])):
        require_once("../../funcao/conexao.php");
        require_once("../../funcao/validacao.php");

        $PDO = CriarConexao();

        if(isset($_GET["idUsuarioRequerido"]) && $tipoUsuario == 1) {
            $idUsuario = $_GET["idUsuarioRequerido"];
        }else{
            $idUsuario = $_SESSION["logado"];
        }
    
        $ListaErro = "";

        $NomeCompleto = $_POST["nomeAlteracaoPerfil"];

        $nomeUsuario = $_POST["usuarioAlteracaoPerfil"];
        if($nomeUsuario != $_SESSION["usuario"]){
            if(ehMesmoNomeUsuario($nomeUsuario, $PDO) != 0){
                $ListaErro .= "<li>Nome de usuário já existente</li>";
                header("location: pagAlterarPerfil.php?listaErroCadastro=".$ListaErro);
                exit();
            }
        }


        $CmdSQL = "SELECT email FROM usuario WHERE id = :idUsuarioRequerido";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(":idUsuarioRequerido", $idUsuario);
        $Prepare->execute();
        
        $emailExistente = $Prepare->fetch(PDO::FETCH_ASSOC);

        $email = $_POST["emailAlteracaoPerfil"];
        if($emailExistente["email"] != $email){
            if(EhMesmoEmail($email, $PDO) != 0):
                $ListaErro .= "<li>Email já existente</li>";
                header("location: pagAlterarPerfil.php?listaErroCadastro=".$ListaErro);
                exit();
            endif;
        }
        unset($emailExistente);

        $Senha = $_POST["passwordAlteracaoPerfil"];
        $ConfirmaSenha = $_POST["confirmPasswordAlteracaoPerfil"];

        if($Senha === $ConfirmaSenha):
            $Senha = password_hash($Senha, PASSWORD_DEFAULT);
        else:
            $ListaErro .= "<li>As senhas não coincidem</li>";
            header("location: pagAlterarPerfil.php?listaErroCadastro=".$ListaErro);
            exit();
        endif;

        $CmdSQL = "UPDATE usuario SET nome = :nomeCompleto, usuario = :nomeUsuario, email = :email, senha = :senha WHERE id = :idUsuarioRequerido";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(':nomeCompleto',$NomeCompleto);
        $Prepare->bindParam(':email',$email);
        $Prepare->bindParam(':senha',$Senha);
        $Prepare->bindParam(':nomeUsuario',$nomeUsuario);
        $Prepare->bindParam(":idUsuarioRequerido",$idUsuario);

        $Resultado = $Prepare->execute();

        header("location: pagAlterarPerfil.php?msgSucesso=<li>Cadastro feito com sucesso!</li>");
    else:
        header("location: pagPublicacao.php");
    endif;
?>