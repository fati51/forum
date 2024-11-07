

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('actions/showArticleContentAction.php');
require('actions/postAnswerAction.php');
require('actions/showAllAnswersOfQuestionAction.php');
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
if(isset($errorMsg)){
    echo $errorMsg;
}

if(isset($question_date_publication)){
?>
<section class="show-content">
    <h3><?= $question_title; ?></h3>
    <hr>
    <p><?= $question_content; ?></p>
    <hr>
    <small><?= $question_pseudo_author . ' ' . $question_date_publication; ?></small>
</section>
<br>
<section class="show-answers">
    <form class="form-group" method="POST">
        <div class="mb-3">
            <label for="exampleInputAnswer" class="form-label">Réponse:</label>
            <textarea name="answer" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary" type="submit" name="validate">Répondre</button>
    </form>
   <?php
   while($answer = $getAllAnswersOfThisQuestion->fetch()){
   ?>
   <div class="card">
    <div class="card-header">
        <?= $answer['pseudo_auteur'];?>
    </div>
    <div class="card-body">
    <?= $answer['contenu'];?>
    </div>
   </div>
   <br>
   <?php


   }
   
   ?>


</section>
<?php
}
?>
</div>
</body>


</html>
