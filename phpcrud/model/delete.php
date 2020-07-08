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
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id=?');
    $stmt->execute([$_GET['id']]);
    $contato = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$contato){
        exit ('O ID não corresponde a esse contato');
    }

    if(isset($_GET['confirma'])){
        if($_GET['confirma'] == 'yes'){

            $stmt = $pdo->prepare('DELETE FROM contatos WHERE id=?');
            $stmt->execute([$_GET['id']]);
            $msg = 'O contato foi excluido do banco de dados';
        }else{
            header('location:consulta.php');
            exit;
        }
    }
}else{
    exit ('ID não espercificado');
}

?>
<?-template_header('delete')?>
<div class="delete">
    <h2>Deletar Contato #<?=$contato['id']?></h2>
    <?php if($msg):?>
        <p><?=$msg?></p>
    <?php else:?>
        <p>Tem certeza que deseja excluir o contato #<?=$contato['id']?></p>
        <div class="escolha">
            <a href="delete.php?id=<?=$contato['id']?>&confirma=yes">Sim</a>
            <a href="delete.php?id=<?=$contato['id']?>&confirma=no">Não</a>
        </div>
    <?php endif;?>

</div>
<?-template_footer()?>