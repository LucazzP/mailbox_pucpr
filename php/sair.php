<?php
    session_destroy();						//Destroi a seção por segurança
    header("Location: /index.html"); 
    exit;	//Redireciona o visitante para login
?>