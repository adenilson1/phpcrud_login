<?php
    session_start();
    if(isset($_SESSION["nome"]) && isset($_SESSION["senha"])){
        echo "Acesso Permitido";
        header('location:../model/home.php');

    }else{
        echo "Acesso negado";
        header('location:../index.html');
    }

?>