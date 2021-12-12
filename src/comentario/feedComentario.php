<?php
    function listarComentario($PDO,$idPost){
        $sql = "SELECT id, id_usuario, texto, dt_comentario FROM comentario WHERE id_post = :idPost";
        $consulta = $PDO->prepare($sql);
        $consulta->bindParam(":idPost",$idPost);
        $consulta->execute();
        
        $comentarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $comentarios;
    }
?>