<?php 
    session_start();

    require_once("../../funcao/conexao.php");

    $PDO = CriarConexao();

    $idPostOuComent = $_GET["idPostOuComent"];
    $gostei_de_post_ou_coment = $_GET["gostei_de_post_ou_coment"];
    $idUser = $_SESSION["logado"];

    $sql = "DELETE FROM gostei WHERE id_post_ou_coment = :idPostOuComent AND id_usuario = :idUser AND gostei_de_post_ou_coment = :gostei_de_post_ou_coment";
    $consulta = $PDO->prepare($sql);
    $consulta->bindParam(":idUser",$idUser);
    $consulta->bindParam(":idPostOuComent", $idPostOuComent);
    $consulta->bindParam(":gostei_de_post_ou_coment",$gostei_de_post_ou_coment);
    $consulta->execute();

    $pagRetorno = $_GET["pagRetorno"];

    if($pagRetorno == "pagPublicacao"){
        header("location: pagPublicacao.php");
    }else {
        header("location: pagPesquisaUsuario.php?nomeUsuarioPesquisado=".urlencode($_GET["nomeUsuarioPesquisado"]));
    }
?>