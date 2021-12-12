<?php
    function listarPost($PDO,$idUsuario){
        $sql = "SELECT id, nome_img, texto, dt_postagem, alterado  FROM posts WHERE id_usuario = :idUsuario";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":idUsuario",$idUsuario);
        $consulta->execute();
        
        $posts = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }
?>