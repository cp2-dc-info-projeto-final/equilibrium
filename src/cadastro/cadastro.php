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
            $ListaErro = "<li style='color:red;list-style-type:none;'>Nome de usuário já existente</li>";
            header("location: pagCadastro.php?listaErroCadastro=".urlencode($ListaErro));
            exit();
        }

        $Email = $_POST["emailCadastro"];
        if(EhMesmoEmail($Email, $PDO) != 0):
            $ListaErro = "<li style='color:red;list-style-type:none;'>Email já existente</li>";
            header("location: pagCadastro.php?listaErroCadastro=".urlencode($ListaErro));
            exit();
        endif;
        

        $Senha = $_POST["passwordCadastro"];
        $ConfirmaSenha = $_POST["confirmPasswordCadastro"];

        if($Senha === $ConfirmaSenha):
            $Senha = password_hash($Senha, PASSWORD_DEFAULT);
        else:
            $ListaErro = "<li style='color:red;list-style-type:none;'>As senhas não coincidem</li>";
            header("location: pagCadastro.php?listaErroCadastro=".urlencode($ListaErro));
            exit();
        endif;

        $CmdSQL = "INSERT INTO usuario (usuario, nome, email, senha, admin) VALUES (:nomeUsuario, :nomeCompleto, :email, :senha, 0)";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(':nomeCompleto',$NomeCompleto);
        $Prepare->bindParam(':email',$Email);
        $Prepare->bindParam(':senha',$Senha);
        $Prepare->bindParam(':nomeUsuario',$nomeUsuario);
        $Prepare->execute();

        header("location: ../inicial/index.php?msgSucesso=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Cadastro feito com sucesso!</li>"));
    else:
        header("location: pagCadastro.php");
    endif;
?>