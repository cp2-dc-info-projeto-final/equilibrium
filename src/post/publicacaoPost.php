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

            $imageFileType = strtolower(pathinfo($_FILES["imgPostName"]["name"], PATHINFO_EXTENSION));

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

            move_uploaded_file($_FILES["imgPostName"]["tmp_name"], $target_file); 

            $texto = $_POST["descricaoPostagem"];
            $dtPublicacao = date("Y-m-d");

            $sql = "INSERT INTO posts(id_usuario, texto, nome_img, dt_postagem,alterado) VALUES (:id_usuario, :texto, :imgName, :dtPublicacao,0)";
            $consulta = $PDO->prepare($sql);
            $consulta->bindParam(":id_usuario",$idUsuario);
            $consulta->bindParam(":texto",$texto);
            $consulta->bindParam(":imgName",$imgName);
            $consulta->bindParam(":dtPublicacao",$dtPublicacao);
            $consulta->execute();
            
            if($_GET["pagRetorno"] == "pagPesquisaUsuario"){
                header("Location: ../usuario/usuarioComum/pagPesquisaUsuario.php?nomeUsuarioPesquisado=".urlencode($_GET["nomeUsuarioPesquisado"]));
            }else{
                header("Location: ../usuario/usuarioComum/pagPublicacao.php");
            }
        }
    }else{
        if($_GET["pagRetorno"] == "pagPesquisaUsuario"){
            header("Location: ../usuario/usuarioComum/pagPesquisaUsuario.php?nomeUsuarioPesquisado=".urlencode($_GET["nomeUsuarioPesquisado"]));
        }else{
            header("Location: ../usuario/usuarioComum/pagPublicacao.php");
        }
    }

    exit();
?>