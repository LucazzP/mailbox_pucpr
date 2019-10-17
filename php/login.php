<?php
#versao do encoding xml
$dom = new DOMDocument("1.0", "ISO-8859-1");

#retirar os espacos em branco
$dom->preserveWhiteSpace = false;

#gerar o codigo
$dom->formatOutput = true;

#criando o nó principal (root)
$root = $dom->createElement("tabelaUsuarios");

#nó filho (usuario)
$usuario = $dom->createElement("usuario");

#setanto emails e atributos dos elementos xml (nós)
$email = $dom->createElement("email", "renanteste@gmail.com.br");
$senha = $dom->createElement("senha", "12345");

#adiciona os nós (informacaoes do usuario) em usuario
$usuario->appendChild($email);
$usuario->appendChild($senha);

#adiciona o nó usuario em (root) tabelaUsuarios
$root->appendChild($usuario);
$dom->appendChild($root);

# Para salvar o arquivo, descomente a linha
$dom->save("usuarios.xml");

#cabeçalho da página
header("Content-Type: text/xml");
# imprime o xml na tela
print $dom->saveXML();
?>