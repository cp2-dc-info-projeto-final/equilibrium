<?php
    session_start();

    if(isset($_POST["btnSalvarPerfil"])){
        require_once("../../funcao/conexao.php");
        require_once("../../funcao/validacao.php");

        $PDO = CriarConexao();
        
        $idUsuarioRequerido = $_GET["idUsuarioRequerido"];
        
        $ListaErro = "";

        $NomeCompleto = $_POST["nomeAlteracaoPerfil"];

        $CmdSQL = "SELECT usuario, email FROM usuario WHERE id = :idUsuarioRequerido";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(":idUsuarioRequerido", $idUsuarioRequerido);
        $Prepare->execute();
        
        $dadoUsuarioRequerido = $Prepare->fetch(PDO::FETCH_ASSOC);

        $nomeUsuario = $_POST["usuarioAlteracaoPerfil"];

        if($nomeUsuario != $dadoUsuarioRequerido["usuario"]){
            if(ehMesmoNomeUsuario($nomeUsuario, $PDO) > 0){
                $ListaErro = "<li style='color:red;list-style-type:none;'>Nome de usuário já existente</li>";
                header("location: pagAlterarPerfil.php?idUsuarioRequerido=".$idUsuarioRequerido."&listaErroAlteracaoPerfil=".urlencode($ListaErro));
                exit();
            }
        }


        $email = $_POST["emailAlteracaoPerfil"];
        if($dadoUsuarioRequerido["email"] != $email){
            if(EhMesmoEmail($email, $PDO) > 0){
                $ListaErro = "<li style='color:red;list-style-type:none;'>Email já existente</li>";
                header("location: pagAlterarPerfil.php?idUsuarioRequerido=".$idUsuarioRequerido."&listaErroAlteracaoPerfil=".urlencode($ListaErro));
                exit();
            }
        }
        unset($emailExistente);

        $CmdSQL = "UPDATE usuario SET nome = :nomeCompleto, usuario = :nomeUsuario, email = :email WHERE id = :idUsuarioRequerido";

        $Prepare = $PDO->prepare($CmdSQL);
        $Prepare->bindParam(':nomeCompleto',$NomeCompleto);
        $Prepare->bindParam(':email',$email);
        $Prepare->bindParam(':nomeUsuario',$nomeUsuario);
        $Prepare->bindParam(":idUsuarioRequerido", $idUsuarioRequerido);

        $Resultado = $Prepare->execute();

        if($dadoUsuarioRequerido["usuario"] != $nomeUsuario && $idUsuarioRequerido == $_SESSION["logado"]){
            $_SESSION["usuario"] = $nomeUsuario;
        }
        if ($_SESSION["tipoUsuario"] == 1) {
            header("location: pagAlterarPerfil.php?idUsuarioRequerido=".$idUsuarioRequerido."&msgSucessoAlteracaoPerfil=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Alteração feita com sucesso!</li>"));
            exit();
        }

        header("location: pagAlterarPerfil.php?msgSucessoAlteracaoPerfil=".urlencode("<li style='color:#1ABC9C;list-style-type:none;'>Alteração feita com sucesso!</li>"));
        
    }else{
        header("location: ../../inicial/index.php");
    }
?>