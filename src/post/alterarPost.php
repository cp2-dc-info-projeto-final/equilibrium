<?php
    if (isset($_POST['btnAlterarPost'])) {
        require_once("../funcao/conexao.php");

        session_start();

        $idUsuario = $_SESSION["logado"];
        $idPostagem = $_GET["idPostagem"];

        $PDO = CriarConexao();

        if ($_FILES["imgAlteracaoPostName"]["error"] > 0) {
            $texto = $_POST["textoPostAlterado"];
            $dtPublicacao = date("Y-m-d");

            $sql = "UPDATE posts SET texto = :texto, dt_postagem = :dtPublicacao, alterado = 1 WHERE id_usuario = :id_usuario AND id = :idPostagem";
            $consulta = $PDO->prepare($sql);
            $consulta->bindParam(":id_usuario", $idUsuario);
            $consulta->bindParam(":texto", $texto);
            $consulta->bindParam(":dtPublicacao", $dtPublicacao);
            $consulta->bindParam(":idPostagem", $idPostagem);
            $consulta->execute();

            if($consulta) {
                header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            }
        }else{
            $dirPastaPostImg = "../imagens/post/";

            if(!file_exists($dirPastaPostImg)){
                mkdir($dirPastaPostImg);
            }

            $imgName = $_FILES["imgAlteracaoPostName"]["name"];
            move_uploaded_file($_FILES["imgAlteracaoPostName"]["tmp_name"], $dirPastaPostImg.$imgName); 

            $texto = $_POST["textoPostAlterado"];
            $dtPublicacao = date("Y-m-d");

            $sql = "UPDATE posts SET texto = :texto, dt_postagem = :dtPublicacao, alterado = 1, nome_img = :imgName WHERE id_usuario = :id_usuario AND id = :idPostagem";
            $consulta = $PDO->prepare($sql);
            $consulta->bindParam(":id_usuario",$idUsuario);
            $consulta->bindParam(":texto",$texto);
            $consulta->bindParam(":imgName",$imgName);
            $consulta->bindParam(":dtPublicacao",$dtPublicacao);
            $consulta->bindParam(":idPostagem", $idPostagem);
            $consulta->execute();
            
            if($consulta){
                header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            }
        }
    }else{
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
        exit();
    }
?>