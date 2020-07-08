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

    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

    $records_per_page = 5;

    $stmt = $pdo->prepare('SELECT * FROM contatos ORDER BY id LIMIT :current_page, :record_per_page');
    $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT); 
    $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    
    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num_contatos = $pdo->query('SELECT COUNT(*) FROM contatos')->fetchColumn();

?>
<?-template_header('consulta')?>
<div class = "contato">
    <h2>Agenda de Contatos</h2>
    <a href = "inserir.php" class = "inserir">Inserir Novo Contato</a>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Cargo</td>
                <td>E-mail</td>
                <td>Celular</td>
                <td></td>
          </tr>
        </thead>
        <tbody>
            <?php foreach($contatos as $contato):?>
                <tr>
                    <td><?=$contato['id']?></td>
                    <td><?=$contato['nome']?></td>
                    <td><?=$contato['cargo']?></td>
                    <td><?=$contato['email']?></td>
                    <td><?=$contato['celular']?></td>
                    <td class="atos">
                        <a href="update.php?id=<?=$contato['id']?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="delete.php?id=<?=$contato['id']?>" class="trash"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                    
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="paginacao">
        
        <?php if($page > 1):?>
            <a href="consulta.php?page=<?=$page-1?>"><i class="fa fa-angle-double-left fa-sm"></i></a>
        <?php endif;?>

        <?php if($page*$records_per_page < $num_contatos):?>
            <a href="consulta.php?page=<?=$page+1?>"><i class="fa fa-angle-double-right fa-sm"></i></a>
        <?php endif;?>

    </div>
</div>
<?-template_footer()?>


