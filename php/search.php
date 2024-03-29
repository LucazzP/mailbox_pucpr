<?php

    session_start(); 	//A seção deve ser iniciada em todas as páginas
    if (!isset($_SESSION['email'])) {		//Verifica se há seções
        session_destroy();						//Destroi a seção por segurança
        header("Location: /index.html"); 
        exit;	//Redireciona o visitante para login
    }

    $dom = new DOMDocument("1.0", "ISO-8859-1");
    $dom = simplexml_load_file("../xml/emails.xml") or die("Error: Objeto inexistente!");
    #retirar os espacos em branco
    $dom->preserveWhiteSpace = false;
    $dadosFiltrados = array();
    $busca = $_POST['search'];

    foreach($dom->children() as $email){
        if($email->para == $_SESSION['email'] || $email->cc == $_SESSION['email']){
            if(preg_match("/{$busca}/i", "{$email->de}")) {
                array_push($dadosFiltrados, json_encode($email));
            } else if(preg_match("/{$busca}/i", "{$email->assunto}")) {
                array_push($dadosFiltrados, json_encode($email));
            } else if(preg_match("/{$busca}/i", "{$email->texto}")){
                array_push($dadosFiltrados, json_encode($email));
            }
        }
    }

    echo json_encode($dadosFiltrados);
    
?>
