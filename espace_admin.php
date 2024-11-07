<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Vérifiez si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php'); // Redirigez vers la page de connexion admin si non connecté
    exit;
}


try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Code de traitement pour supprimer un utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer_users"])) {
    // Récupérez l'ID de l'utilisateur en fonction du nom d'utilisateur fourni
    $nom_utilisateur = isset($_POST["nom_utilisateur"]) ? $_POST["nom_utilisateur"] : "";

    // Exécutez une requête SQL pour obtenir l'ID de l'utilisateur en fonction du nom d'utilisateur
    $getUserIdQuery = $bdd->prepare('SELECT id FROM users WHERE pseudo = ?');
    $getUserIdQuery->execute([$nom_utilisateur]);
    $row = $getUserIdQuery->fetch();

    if ($row) {
        $utilisateur_id = $row['id'];
        // Exécutez la requête SQL pour supprimer l'utilisateur en fonction de son ID
        $deleteUserQuery = $bdd->prepare('DELETE FROM users WHERE id = ?');
        $deleteUserQuery->execute([$utilisateur_id]);
        // Affichez un message de confirmation
        $confirmationMessage = "L'utilisateur '$nom_utilisateur' a été supprimé avec succès.";
    } else {
        // L'utilisateur avec ce nom d'utilisateur n'a pas été trouvé, affichez un message d'erreur
        $errorMessage = "Utilisateur non trouvé.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer_question"])) {
    // Récupérez le titre de la question à supprimer
    $titre_question = isset($_POST["titre"]) ? $_POST["titre"] : "";
    $deleteQuestionQuery = $bdd->prepare('DELETE FROM questions WHERE titre = ?');
if (!$deleteQuestionQuery) {
    echo "Erreur de préparation de la requête : " . $bdd->errorInfo()[2];
} else {
    $result = $deleteQuestionQuery->execute([$titre_question]);
    if (!$result) {
        echo "Erreur d'exécution de la requête : " . $deleteQuestionQuery->errorInfo()[2];
    } else {
        $questionConfirmationMessage = "La question '$titre_question' a été supprimée avec succès.";
    }
}


    // Exécutez une requête SQL pour supprimer la question en fonction de son titre
    $deleteQuestionQuery = $bdd->prepare('DELETE FROM questions WHERE titre = ?');
    $deleteQuestionQuery->execute([$titre_question]);

    // Affichez un message de confirmation
    $questionConfirmationMessage = "La question '$titre_question' a été supprimée avec succès.";

    // Code de traitement pour supprimer une réponse
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer_reponse"])) {
    // Récupérez le titre de la question associée et le contenu de la réponse à supprimer
    $titre_question_reponse = isset($_POST["titre_question_reponse"]) ? $_POST["titre_question_reponse"] : "";
    $contenu_reponse = isset($_POST["contenu_reponse"]) ? $_POST["contenu_reponse"] : "";

    // Exécutez une requête SQL pour supprimer la réponse en fonction du titre de la question et du contenu
    $deleteReponseQuery = $bdd->prepare('DELETE FROM answers WHERE titre_question = ? AND contenu = ?');
    $deleteReponseQuery->execute([$titre_question_reponse, $contenu_reponse]);

    // Affichez un message de confirmation
    $reponseConfirmationMessage = "La réponse associée à la question '$titre_question_reponse' a été supprimée avec succès.";
}

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Espace administrateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>
<br><br>
    <h1>Espace administrateur</h1>
    
    <!-- Lien de déconnexion pour l'administrateur -->
    <p><a href="deconnexion_admin.php">Déconnexion</a></p>

    <!-- Formulaire pour supprimer un utilisateur -->
    <h2>Supprimer un utilisateur</h2>
    <?php if (isset($confirmationMessage)) { ?>
        <p class="text-success"><?php echo $confirmationMessage; ?></p>
    <?php } ?>
    <?php if (isset($errorMessage)) { ?>
        <p class="text-danger"><?php echo $errorMessage; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nom_utilisateur">Nom d'utilisateur à supprimer :</label>
        <input type="text" name="nom_utilisateur" required><br>
        <button type="submit" name="supprimer_users" class="btn btn-danger">Supprimer</button>
    </form>
     <!-- Formulaire pour supprimer une question -->
     <h2>Supprimer une question</h2>
    <?php if (isset($questionConfirmationMessage)) { ?>
        <p class="text-success"><?php echo $questionConfirmationMessage; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="titre_question">Titre de la question à supprimer :</label>
        <input type="text" name="titre_question" required><br>
        <button type="submit" name="supprimer_question" class="btn btn-danger">Supprimer la question</button>
    </form>
    <!-- Formulaire pour supprimer une réponse -->
<h2>Supprimer une réponse</h2>
<?php if (isset($reponseConfirmationMessage)) { ?>
    <p class="text-success"><?php echo $reponseConfirmationMessage; ?></p>
<?php } ?>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="titre_question">Titre de la question associée :</label>
    <input type="text" name="titre_question_reponse" required><br>
    <label for="contenu_reponse">Contenu de la réponse à supprimer :</label>
    <textarea name="contenu_reponse" required></textarea><br>
    <button type="submit" name="supprimer_reponse" class="btn btn-danger">Supprimer la réponse</button>
</form>


    <!-- Formulaire pour supprimer une réponse -->
    <!-- Ajoutez le formulaire de suppression de réponse ici selon vos besoins -->
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
