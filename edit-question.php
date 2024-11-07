<?php
require('actions/getInfoOfEditedQuestionAction.php');
require('actions/editQuestionAction.php');

require('actions/securityAction.php');

?>



<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php'; ?>
<br><br>
<div class="container">
<?php 
    if(isset($errorMsg)) {
        echo '<p>' . $errorMsg . '</p>';
    }
   
    if(isset($question_content)) {
?>
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Titre de la question</label>
            <input type="text" class="form-control" name="title" value="<?= $question_title ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description de la question</label>
            <textarea class="form-control" name="description"><?= $question_description ?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Contenu de la question</label>
            <textarea type="text" class="form-control" name="content"><?= $question_content ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="validate">Modifier la question</button>
    </form> 
<?php
    }
?>
</div>
</body>
</html>
