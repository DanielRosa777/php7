<?php
    require_once("config.php");

    $root = new Usuario();

    $root->loadById(9);

    echo $root;


?>
