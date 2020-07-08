<?php
    include '../controller/functions.php';
    echo <<< EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>title</title>
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
                    <a href="../index.html"><i class="fa fa-sign-out"></i>Sair</a>
                </div>
            </nav>
        </body>
    </html>
EOT;
        
?>
<?-template_header('Home')?>
<div class="conteudo">
    <h2>Home</h2>
    <p>Bem vido a pagina principal</p>
</div>
<?-template_footer()?>