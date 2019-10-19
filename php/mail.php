<?php
   $json = $_POST;

   $dom = new DOMDocument("1.0", "ISO-8859-1");
   $dom->load("../xml/emails.xml");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;

   $root = $dom->getElementsByTagName("tabelaEmails")-> item(0);

   $email = $dom->createElement("email");

   $email->setAttribute("id", 0);
   $email->setAttribute("de", $json['de']);
   $email->setAttribute("para", $json['para']);
   
   $root = $dom->createElement("cc", $json['cc']);
   $email->appendChild($root);

   $root = $dom->createElement("assunto", $json['assunto']);
   $email->appendChild($root);

   $root = $dom->createElement("texto", $json['texto']);
   $email->appendChild($root);

   $dom->appendChild($root);

   $dom->save("../xml/emails.xml");
?>
