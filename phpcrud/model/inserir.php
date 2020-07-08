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

$pdo = pdo_connect_bd();
$msg = "";

if(!empty($_POST)){

     
            $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
        
            $stmt = $pdo->prepare('INSERT INTO contatos VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$id, $nome, $cargo, $email, $celular]);
        
            $msg = 'Inserido com sucesso !!' ;
}
?>
<?-template_header('inserir')?>

<div class="atualizar">
    <h2>Novo Contato</h2>
    <form action="inserir.php" method="post">
        <label for="id">ID</label>
        <label for="nome">Nome</label>
        <input type="text" name="id"  placeholder="o id de sua preferencia" value="auto" id="id">
        <input type="text" name="nome" required placeholder="Seu nome completo" id="nome">
        <label for="cargo">Cargo</label>
        <label for="email">Email</label> 
       
        <input type="text" name="cargo" required placeholder="Seu cargo"  id="cargo">     
        <input type="text" name="email" required placeholder="nome@exemplo.com" id="email">
        
        <label for="celular">Celular</label> 
        <label>Click para inserir</label>
        <input type="text" name="celular" required placeholder="(XX) 9 XXXX-XXXX" id="celular">
        
        <input type="submit" value="Inserir">

    </form>
    <?php if($msg):?>
        <p><?=$msg?></p>
    <?php endif;?>
    
</div>
<?-template_footer()?>