<?php
    session_start();

    if(isset($_POST["btnCadastrar"])):
        require_once("../funcao/conexao.php");
        require_once("../funcao/validacao.php");

        $PDO = CriarConexao();
    
        $ListaErro = "";

        $NomeCompleto = $_POST["nomeCadastro"];

        $nomeUsuario = $_POST["usuarioCadastro"];
        if(ehMesmoNomeUsuario($nomeUsuario, $PDO) != 0){
            $ListaErro .= "<li>Nome de usuário já existente</li>";
            header("location: pagCadastro.php?listaErroCadastro=".$ListaErro);
            exit();
        }

        $Email = $_POST["emailCadastro"];
        if(EhMesmoEmail($Email, $PDO) != 0):
            $ListaErro .= "<li>Email já existente</li>";
            header("location: pagCadastro.php?listaErroCadastro=".$ListaErro);
            exit();
        endif;
        

        $Senha = $_POST["passwordCadastro"];
        $ConfirmaSenha = $_POST["confirmPasswordCadastro"];

        if($Senha === $ConfirmaSenha):
            $Senha = password_hash($Senha, PASSWORD_DEFAULT);
        else:
            $ListaErro .= "<li>As senhas não coincidem</li>";
            header("location: pagCadastro.php?listaErroCadastro=".$ListaErro);
            exit();
        endif;

        $CmdSQL = "INSERT INTO usuario (usuario, nome, email, senha, admin) VALUES (:nomeUsuario, :nomeCompleto, :email, :senha, 0)";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(':nomeCompleto',$NomeCompleto);
        $Prepare->bindParam(':email',$Email);
        $Prepare->bindParam(':senha',$Senha);
        $Prepare->bindParam(':nomeUsuario',$nomeUsuario);
        $Prepare->execute();

        header("location: ../inicial/index.php?msgSucesso=<li>Cadastro feito com sucesso!</li>");
    else:
        header("location: pagCadastro.php");
    endif;
?>