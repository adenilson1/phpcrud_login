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
if(isset($_GET['id'])){

    if(!empty($_POST)){
        
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    
        $stmt = $pdo->prepare('UPDATE contatos SET id=?, nome=?, cargo=?, email=?, celular=? WHERE id=?');
        $stmt->execute([$id, $nome, $cargo, $email, $celular, $_GET['id']]);
    
        $msg = 'Atualizado com sucesso !!' ;
    }

    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id=?');
    $stmt->execute([$_GET['id']]);
    $contato = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$contato){
        exit ('O ID não corresponde a esse contato');
    }
}else{
    exit ('ID não espercificado');
}

?>

<?-template_header('atualizar')?>

<div class="update">
    <h2>Atualizar Contato #<?=$contato['id']?></h2>
    <form action="update.php?id=<?=$contato['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nome">Nome</label>

        <input type="text" name="id"  placeholder="o id de sua preferencia" value="<?=$contato['id']?>" id="id">
        <input type="text" name="nome" required placeholder="Seu nome completo" value="<?=$contato['nome']?>" id="nome">

        <label for="cargo">Cargo</label>
        <label for="email">Email</label> 
       
        <input type="text" name="cargo" required placeholder="Seu cargo" value="<?=$contato['cargo']?>" id="cargo">     
        <input type="text" name="email" required placeholder="nome@nome.com" value="<?=$contato['email']?>"id="email">
        
        <label for="celular">Celular</label> 
        <label>Click para atualizar</label>
        <input type="text" name="celular" required placeholder="(XX) 9 XXXX-XXXX" value="<?=$contato['celular']?>" id="celular">
        
        <input type="submit" value="Atualizar">

    </form>
    <?php if($msg):?>
        <p><?=$msg?></p>
    <?php endif;?>
    
</div>
<?-template_footer()?>