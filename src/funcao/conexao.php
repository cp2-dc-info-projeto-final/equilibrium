<?php
    set_time_limit(0);
    ignore_user_abort(1);

    function CriarConexao(){

        $PDO = new PDO('mysql:host=localhost;
        dbname=equilibrium;charset=utf8',
        'root',
        '');

        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $PDO;
    }
?>