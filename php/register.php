<?php
    $json = $_POST;
    
    $dom = new DOMDocument("1.0", "ISO-8859-1");
    $dom->load("../xml/usuarios.xml");
    #retirar os espacos em branco
    $dom->preserveWhiteSpace = false;

    $root = $dom->getElementsByTagName("tabelaUsuarios")-> item(0);


    $usuario = $dom->createElement("usuario");
        #criando novo user
        $email = $dom->createElement("email", $json['email']);
        $senha = $dom->createElement("senha", $json['senha']);

    #adicionando no root
    $usuario->appendChild($email);
    $usuario->appendChild($senha);
    $root->appendChild($usuario);
    $dom->appendChild($root);

    #salvando o arquivo
    $dom->save("../xml/usuarios.xml");
    
    #mostrar dados na tela
    header("Content-Type: text/xml");
    print $dom->saveXML();

?>