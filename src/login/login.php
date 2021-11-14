<?php
    session_start();

    if(isset($_POST["btnLogar"])):
        require_once("../funcao/conexao.php");
        
        $PDO = CriarConexao();
        $ListaErros = "";

        $EmailOuUsuario = $_POST["emailOuUsuarioLogin"];
        $Senha = $_POST["passwordLogin"];

        $CmdSQL = "SELECT email, usuario FROM usuario WHERE email = :emailOuUsuario or usuario = :emailOuUsuario";

        $Consulta = $PDO->prepare($CmdSQL);
        $Consulta->bindParam(":emailOuUsuario",$EmailOuUsuario);
        $Consulta->execute();

        if($Consulta->rowCount() > 0):
            $CmdSQL = "SELECT senha FROM usuario WHERE email = :emailOuUsuario or usuario = :emailOuUsuario"; 

            $Consulta = $PDO->prepare($CmdSQL);
            $Consulta->bindParam(":emailOuUsuario",$EmailOuUsuario);
            $Consulta->execute();

            $Hash = $Consulta->fetch(PDO::FETCH_ASSOC);

            if(password_verify($Senha, $Hash['senha'])):
                $CmdSQL = "SELECT usuario, admin, id FROM usuario WHERE email = :emailOuUsuario or usuario = :emailOuUsuario";

                $Consulta = $PDO->prepare($CmdSQL);
                $Consulta->bindParam(":emailOuUsuario", $EmailOuUsuario);
                $Consulta->execute();

                $Dados = $Consulta->fetch(PDO::FETCH_ASSOC);

                $_SESSION["logado"] = $Dados["id"];
                $_SESSION["usuario"] = $Dados["usuario"];
                $_SESSION["tipoUsuario"] = $Dados["admin"];

                header("location: ../usuario/usuarioComum/pagPublicacao.php");

            else:
                $ListaErros = "<li style='color:red;list-style-type:none;'>Senha incorreta</li>";
                header("location: ../inicial/index.php?listaErroLogin=".urlencode($ListaErros));
                exit();
            endif;
        else:
            $ListaErros = "<li style='color:red;list-style-type:none;'>Email incorreto ou inexistente</li>";
            header("location: ../inicial/index.php?listaErroLogin=".urlencode($ListaErros));
            exit();
        endif;
    endif;
?>