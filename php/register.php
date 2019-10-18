<?php
$dom = new DOMDocument("1.0", "ISO-8859-1");
$dom->load("usuarios.xml");
#retirar os espacos em branco
$dom->preserveWhiteSpace = false;

$root = $dom->getElementsByTagName("tabelaUsuarios")-> item(0);


$usuario = $dom->createElement("usuario");
    #criando novo user
    $email = $dom->createElement("email", "samito@lucas.com.br");
    $senha = $dom->createElement("senha", "666666");

#adicionando no root
$usuario->appendChild($email);
$usuario->appendChild($senha);
$root->appendChild($usuario);
$dom->appendChild($root);

#salvando o arquivo
$dom->save("usuarios.xml");

#mostrar dados na tela
header("Content-Type: text/xml");
print $dom->saveXML();

?>