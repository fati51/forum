<?php

session_start();
require ('actions/database.php');



?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php';?>
   <?php
   $recupUser = $bdd->query('SELECT * FROM users ');
   while($user = $recupUser->fetch()){
    ?>
    <a href="sind_message.php?id=<?php echo $user['id'];?>"><p><?php echo $user['pseudo'];?></p></a>

    <?php
   }
   
   ?> 
</body>
</html>