<?php
    $json = $_POST;

    $xml = new DOMDocument('1.0');

    $xml_email = $xml->createElement("email");

    $xml_email->setAttribute("id", 0);
    $xml_email->setAttribute("de", $json['de']);
    $xml_email->setAttribute("para", $json['para']);
    
    $xml_child = $xml->createElement("cc", $json['cc']);
    $xml_email->appendChild($xml_child);

    $xml_child = $xml->createElement("assunto", $json['assunto']);
    $xml_email->appendChild($xml_child);

    $xml_child = $xml->createElement("texto", $json['texto']);
    $xml_email->appendChild($xml_child);

    $xml->appendChild($xml_email);

    $xml->save("save.xml");
?>