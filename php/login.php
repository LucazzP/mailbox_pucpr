<?php
#versao do encoding xml
$dom = new DOMDocument("1.0", "ISO-8859-1");

#retirar os espacos em branco
$dom->preserveWhiteSpace = false;

#gerar o codigo
$dom->formatOutput = true;

#criando o nó principal (root)
$root = $dom->createElement("tabelaEmails");

#nó filho (email)
$email = $dom->createElement("email");

#setanto emails e atributos dos elementos xml (nós)
$de = $dom->createElement("de", "luquinhaspolazito@gmail.com.br");
$para = $dom->createElement("para", "renanteste@gmail.com.br");
$cc = $dom->createElement("cc", "renancc@gmail.com.br");
$assunto = $dom->createElement("assunto", "testerenan");
$texto = $dom->createElement("texto", " assunto bla blah blahbanbenasiubnranbrfndaobif");

#adiciona os nós (informacaoes do email) em email
$email->appendChild($de);
$email->appendChild($para);
$email->appendChild($cc);
$email->appendChild($assunto);
$email->appendChild($texto);

#adiciona o nó email em (root) tabelaEmails
$root->appendChild($email);
$dom->appendChild($root);

# Para salvar o arquivo, descomente a linha
$dom->save("emails.xml");

#cabeçalho da página
header("Content-Type: text/xml");
# imprime o xml na tela
print $dom->saveXML();
?>