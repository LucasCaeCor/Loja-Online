<?php

    session_start(); //Inicia uma sessão

    //Definir o tempo limite da sessão para 10 minutos (em segundos)
    $inatividade = 600; //600 segundos = 10 minutos

    if(!isset($_SESSION['logado']) || $_SESSION['logado'] === false){
        header('location:formLogin.php?erroLogin=naoLogado');
    }
    else{
        $tipoUsuario = $_SESSION['tipoUsuario']; //Captura o tipo de usuário pela sessão
        if($_SESSION['tipoUsuario'] != "administrador"){
            header('location:formLogin.php?erroLogin=acessoProibido');
        }
    }

?>