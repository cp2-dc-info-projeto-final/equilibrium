<?php
    //Verifica se o email já foi cadastrado
    function ehMesmoEmail($email, $PDO){
        $CmdSQL = "SELECT email FROM usuario WHERE email = :email";

        $Consulta  = $PDO->prepare($CmdSQL);
        $Consulta->bindParam(':email', $email);

        $Consulta->execute();

        if($Consulta->rowCount() == 0):
            return 0;
        else:
            return 1;
        endif;
    }

    //Verifica se o nome de usuário já foi cadastrado
    function ehMesmoNomeUsuario($usuario, $PDO){
        $CmdSQL = "SELECT usuario FROM usuario WHERE usuario = :usuario";

        $Consulta  = $PDO->prepare($CmdSQL);
        $Consulta->bindParam(':usuario', $usuario);

        $Consulta->execute();

        if($Consulta->rowCount() == 0):
            return 0;
        else:
            return 1;
        endif;
    }
?>