<?php
    function pdo_connect_bd(){
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "phpcrud";

        try{
            return new PDO("mysql:host=localhost;dbname=phpcrud","root","");

        }catch(PDOException $erro){
            exit('Erro ao tentar conectar ao banco de dados');
        }
    }
    function template_header($title){
        echo <<< EOT
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>$title</title>
                <link rel="stylesheet" type="text/css" href="../css/estilo.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                </head>
            </html>
            <body>
                <nav class="navtop">
                    <div>
                        <h1>Website</h1>
                        <a href="home.php"><i class="fa fa-home"></i>Home</a>
                        <a href="consulta.php"><i class="fa fa-address-book"></i>Contato</a>
                        <a href="../index.html"><i class="fa fa-sign-out" aria-hidden="true">Sair</i></a>
                    </div>
                </nav>
EOT;
    }
    function template_footer(){
        echo <<< EOT
            </body>
        </html>
EOT;
    }
?>