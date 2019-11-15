<?php
    require_once("config.php");

    //$root = new Usuario();

    //$root->loadById(9);

    //$lista = Usuario::getList();

    //$lista = Usuario::search("jo");

    //$usuario = new Usuario();
    //$usuario->login("daniel","123456");

    //$aluno = new Usuario("novo", "123456");
    //$aluno->insert();

    $user = new Usuario();
    $user->loadById(14);

    $user->update("professor","1234567890");

    echo $user;


?>
