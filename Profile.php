
<?php session_start();
require('actions/showOneUsersProfileAction.php');

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php'; ?>
<br><br>

<div class="container">
<?php 
if(isset($errorMsg)){echo $errorMsg;

}
if(isset($getHisQuestion)){
?>
<div class="card">
<div class="card-body">
    <h4><?=$user_pseudo ;?></h4>
    <hr>
    <p><?=$user_lastname.''.$user_firstname ;?></p>

</div>

</div>
<?php
while($question = $getHisQuestion->fetch()){
    ?>
   <div class="card">
    <div class="card-header"><?=$question ['titre'];?></div>
    <div class="card-body"><?=$question ['description'];?></div>
    <div class="card-footer">Par<?=$question ['pseudo_auteur'];?>Le <?=$question ['date_publication'];?></div>
   </div>
   <br>
    <?php
}



}


?>
  </div>  
</body>
</html>