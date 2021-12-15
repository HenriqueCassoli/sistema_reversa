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
      <section class="reserva">
               <div class="center"> 
                   <?php
                    if(isset($_POST['acao'])){
                        $nome=$_POST['nome'];
                        $dataHora=$_POST['dataHora'];
                        $date = DateTime::createFromFormat('d/m/Y H:i:s', $dataHora);
                        $dataHora =$date->format('y-m-d H:i:s');
                        $pdo=new PDO("mysql:host=localhost;dbname=sistema_php","root","");
                        $sql= $pdo ->prepare("INSERT INTO `tb_agendados` VALUES (NULL,?,?)");
                        $sql->execute(array($nome,$dataHora));
                        echo"<div class='sucesso'>Seu horario foi agendado </div>";
                    }
                   ?>
                    <form action="" method="post">
                        <input type="text" name="nome" placeholder="Seu nome ..."/>
                           <select name="dataHora">
                            <?php
                                 for ($i=0; $i <= 23; $i++) { 
                                     $hora = $i;
                                     if($i < 10){
                                        $hora='0'.$hora;
                                     }
                                     $hora.=':00:00';

                                     $verifica = date('Y-m-d').' '.$hora; 
                                     $sql= $pdo->prepare("SELECT * FROM `tb_agendados` WHERE horario ='$verifica'");
                                     $sql->execute();
                                    
                                     if($sql->rowCount() == 0 && strtotime($verifica) >time()){
                                        $dataHora =date('d/m/y').' '.$hora;
                                        echo'<option value="'.$dataHora.'">'.$dataHora.'</option>';
                                     }
                                    
                                 }
                            ?>
                           </select>
                          <input type="submit" value="enviar!!!" name="acao">
                    </form>
                    
               </div>
      </section>
</body>
</html>
