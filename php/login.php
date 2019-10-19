<?php

    $json = $_POST;
    
    $dom = new DOMDocument("1.0", "ISO-8859-1");
    $dom->load("../xml/usuarios.xml");
    #retirar os espacos em branco
    $dom->preserveWhiteSpace = false;
?>