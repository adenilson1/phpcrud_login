<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "phplogin";


try{
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["login"])){

        if(empty($_POST["nome"]) || empty($_POST["senha"])){
            echo "<script>alert('Preencha todos os campos')</script>";

        }else{
            $query = "SELECT * FROM contas WHERE nome = :nome AND senha = :senha";
            $stmt = $connect->prepare($query);
            $stmt->execute(
                array(
                    'nome' => $_POST["nome"],
                    'senha' => $_POST["senha"]
                    )
                );
                $count = $stmt->rowCount();

                if($count > 0){
                    $_SESSION["nome"] = $_POST["nome"];
                    $_SESSION["senha"] = $_POST["senha"];
                    header('location:login_acesso.php');
                    
                }else{
                    echo "<script>alert('Dados incorretos')</script>";
                    header('location:../index.html');
                }
        }
    }
}catch(PDOExeption $erro){
    $message = $erro->getMessage();
}

?>