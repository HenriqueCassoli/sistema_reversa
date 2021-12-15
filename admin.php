<?php
date_default_timezone_set('America/Sao_Paulo');
$pdo=new PDO("mysql:host=localhost;dbname=sistema_php","root","");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema Reverva</title>
    <link rel="stylesheet" href="estilo/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">
</head>
<body>
      <header>
            <div class="center">

               <div class="logo">
                      <h2>Cassoli</h2>
                      
               </div>

               <nav class="menu">
                    <ul>
                        <li><a href="">Resverva</a></li>
                        <li><a href="">Sobre</a></li>
                        <li><a href="">Conta</a></li>
                        
                    </ul>
               </nav>
               <div class="clear"></div>
            </div>
      </header>
  
      <section class="agendamentos"> 
               <div class="center">
                   <?php
                   if (isset($_GET['excluir'])) {
                    $id=(int)$_GET['excluir'];
                   $pdo ->exec("DELETE  FROM `tb_agendados` WHERE id=$id");
                   echo  "<div class='sucesso'>seu horario foi excluido</div>";
                   }
                   $info=$pdo ->prepare("SELECT * FROM `tb_agendados` ");
                   $info->execute();
                   $info =  $info ->fetchAll();
                   foreach($info  as $key => $value){
                   ?>
                    <div  class="box-single">
                           <div class="box-single-wraper">
                                 nome: <?php echo  $value['nome'] ?></br>
                                data: <?php echo  $value['horario'] ?></br>
                                <a href="?excluir=<?php echo $value['id']; ?>">Excluir!</a>
                           </div>
                    </div>                               
                     <?php }?>
                     <div class="clear"></div>
               </div>
               
      </section>
     
</body>
</html>
