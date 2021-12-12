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

            
            header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            
        }else{
            $dirPastaPostImg = "../imagens/post/";

            $sql = "SELECT nome_img FROM posts WHERE id = :idPostagem";
            $consulta = $PDO->prepare($sql);
            $consulta->bindParam(":idPostagem", $idPostagem);
            $consulta->execute();

            $imgName = $consulta->fetch(PDO::FETCH_ASSOC);

            unlink($dirPastaPostImg.$imgName["nome_img"]);

            $imageFileType = strtolower(pathinfo($_FILES["imgAlteracaoPostName"]["name"], PATHINFO_EXTENSION));

            $imgName = uniqid("img_",true) . "." . $imageFileType;

            do{
                $target_file = $dirPastaPostImg . $imgName;
                if (!file_exists($target_file)) { // verifica se ainda não existe arquivo com esse nome
                    break;
                }
            } while(true);

            if(!file_exists($dirPastaPostImg)){
                mkdir($dirPastaPostImg);
            }

            move_uploaded_file($_FILES["imgAlteracaoPostName"]["tmp_name"], $target_file);


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
            
            
            header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            
        }
    }else{
        
        header("Location: ../usuario/usuarioComum/pagPublicacao.php");
        
    }

    exit();
?>