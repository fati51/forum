<?php 


require('actions/showAllQuestionAction.php'); // Assurez-vous que ce fichier inclut la connexion à la base de données et déclare $getAllQuestion

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php';?>
<br><br>
   
<div class="container">
<form method="GET">
   
<div class="form-group row">
<div class="col-8">
    <input type="search" name="search" class="form-control">
</div>
<div class="col-4">
    <button class="btn btn-success" type="submit">Rechercher</button>
</div>
</div>

</form>
<br>

<?php
while ($question = $getAllQuestions->fetch()) {
    ?>
    <div class="card">
        <div class="card-header">
        <a href="article.php?id=<?php echo $question['id']; ?>">
    <?= $question['titre']; ?>
</a>

        </div>
        <div class="card-body">
            <?= $question['description'];?>
        </div>
        <div class="card-footer">
            Publié par <?= $question['pseudo_auteur']; ?> <!-- Assurez-vous que la colonne de pseudo est correcte -->
            le <?= $question['date_publication'];?>
        </div>
    </div>
    <br>
    <?php
}
?>

</div>
</body>
</html>
