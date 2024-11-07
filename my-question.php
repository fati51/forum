<?php require ('actions/myQuestionAction.php');
      require ('actions/securityAction.php'); 

?>



<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php';?>

<br><br>
<div class="container">
<?php
while($question = $getAllMyQuestions->fetch()){
    ?>
  <div class="card">
  <h5 class="card-header"><a href="article.php?id=<?php echo $question['id']; ?>">
    <?= $question['titre']; ?>
</a> </h5>
  <div class="card-body">
   
    <p class="card-text"><?= $question ['description']; ?> </p>
    <a href="article.php?id=<?=$question['id'];?>" class="btn btn-primary">Accéder à question </a>
    <a href="edit-question.php?id=<?=$question['id'];?>" class="btn btn-warning">Modifier la question </a>  
    <a href="actions/deleteQuestionAction.php?id=<?=$question['id'];?>" class="btn btn-danger">supprimer la question </a>  

</div>
</div>

<br>
    <?php
}


?>
<div class="message">
  <p>Contenu du message</p>
  <div class="vote-buttons">
    <button class="like-button">Like</button>
    <span class="like-count">0</span>
    <button class="dislike-button">Dislike</button>
    <span class="dislike-count">0</span>
  </div>
</div>


</div>

<script src="app.js"></script>

</body>
</html>