<?php
function addusuario($document, $email, $senha)
{
 #criar usuario
 $usuario = $document->createElement("usuario");

 #criar nó email
 $email = $document->createElement("email", $email);

 #senha
 $senha = $document->createElement("telesenha", $senha);


 $usuario->appendChild($email);
 $usuario->appendChild($senha);
 return $usuario;
}

$dom = new DOMDocument("1.0", "ISO-8859-1");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

$root = $dom->createElement("tabelaUsuarios");

#utilizando a funcao para criar usuarios
$lucas = addusuario($dom, "lucas@lucas.com.br", "456123");
$pedro = addusuario($dom, "pedro@pedro.com.br", "321654");

#adicionando no root
$root->appendChild($Tiao);
$root->appendChild($Joao);
$dom->appendChild($root);

#salvando o arquivo
$dom->save("usuarios.xml");

#mostrar dados na tela
header("Content-Type: text/xml");
print $dom->saveXML();

?>