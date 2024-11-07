<?php 
 require ('actions/publishQuestionAction.php');
 require ('actions/securityAction.php'); 
 ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php';?>


<br><br>
<form class="container" method="POST">
    <?php 
    if(isset ($errorMsg))
    {
     echo '<p>'.$errorMsg.'</p>' ;}

     elseif(isset ( $successMsg))
     {
      echo '<p>'.$successMsg.'</p>' ;

     }
    
    ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Titre de la question </label>
    <input type="text" class="form-control" name="title">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description de la question </label>
    <textarea  class="form-control" name="description" > </textarea>
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contenu de la question</label>
    <textarea type="text" class="form-control"name="content" ></textarea>
   
  </div>
  
  
  <button type="submit" class="btn btn-primary"name="validate">publier la question </button>
  
</form> 
</body>
</html>