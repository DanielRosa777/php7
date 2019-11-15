<?php
    require_once("config.php");

    //$root = new Usuario();

    //$root->loadById(9);

    //$lista = Usuario::getList();

    //$lista = Usuario::search("jo");

    $usuario = new Usuario();
    $usuario->login("daniel","123456");

    echo $usuario;


?>
