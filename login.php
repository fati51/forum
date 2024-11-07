
<?php require ('actions/loginAction.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<link rel="stylesheet" href="style.css">
<body>
<br><br>
<form class="container" method="POST">
    <?php 
    if(isset ($errorMsg)){ echo '<p>'.$errorMsg.'</p>' ;}
    
    ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Pseudo</label>
    <input type="text" class="form-control" name="pseudo">
   
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary"name="validate">Se connecter</button>

  <br></br>
  <a href="signup.php"><p>Je m 'inscrit</p></a>
</form>
</body>
</html>