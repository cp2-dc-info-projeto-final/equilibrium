<?php
    if (isset($_POST['btnPublicar'])) {
        require_once("../funcao/conexao.php");

        session_start();

        $idUsuario = $_SESSION["logado"];

        $PDO = CriarConexao();

        if ($_FILES["imgPostName"]["error"] > 0) {
            $texto = $_POST["descricaoPostagem"];
            $dtPublicacao = date("Y-m-d");

            $sql = "INSERT INTO posts(id_usuario,texto,dt_postagem,alterado) VALUES (:id_usuario, :texto, :dtPublicacao,0)";
            $consulta = $PDO->prepare($sql);
            $consulta->bindParam(":id_usuario",$idUsuario);
            $consulta->bindParam(":texto",$texto);
            $consulta->bindParam(":dtPublicacao",$dtPublicacao);
            $consulta->execute();

            if($consulta) {
                header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            }
        }else{
            $dirPastaPostImg = "../imagens/post/";

            if(!file_exists($dirPastaPostImg)){
                mkdir($dirPastaPostImg);
            }

            $imgName = $_FILES["imgPostName"]["name"];
            move_uploaded_file($_FILES["imgPostName"]["tmp_name"], $dirPastaPostImg.$imgName); 

            $texto = $_POST["descricaoPostagem"];
            $dtPublicacao = date("Y-m-d");

            $sql = "INSERT INTO posts(id_usuario, texto, nome_img, dt_postagem,alterado) VALUES (:id_usuario, :texto, :imgName, :dtPublicacao,0)";
            $consulta = $PDO->prepare($sql);
            $consulta->bindParam(":id_usuario",$idUsuario);
            $consulta->bindParam(":texto",$texto);
            $consulta->bindParam(":imgName",$imgName);
            $consulta->bindParam(":dtPublicacao",$dtPublicacao);
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