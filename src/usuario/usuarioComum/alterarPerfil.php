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

        $CmdSQL = "UPDATE usuario SET nome = :nomeCompleto, usuario = :nomeUsuario, email = :email WHERE usuario = :usuario";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(':nomeCompleto',$NomeCompleto);
        $Prepare->bindParam(':email',$email);
        $Prepare->bindParam(':nomeUsuario',$nomeUsuario);
        $Prepare->bindParam(":usuario", $usuarioRequerido);

        $Resultado = $Prepare->execute();

        if($usuarioRequerido != $nomeUsuario && $usuarioRequerido == $_SESSION["usuario"]){
            $_SESSION["usuario"] = $nomeUsuario;
        }
        if ($_SESSION["tipoUsuario"] == 1) {
            header("location: pagAlterarPerfil.php?usuarioRequerido=".$nomeUsuario."&msgSucessoAlteracaoPerfil=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Alteração feita com sucesso!</li>"));
            exit();
        }

        header("location: pagAlterarPerfil.php?msgSucessoAlteracaoPerfil=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Alteração feita com sucesso!</li>"));
        
    }else{
        header("location: ../../inicial/index.php");
    }
?>