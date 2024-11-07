<?php
// démarrée une session 
session_start();


require('actions/database.php');

// Vérifier si le formulaire a été soumis
if(isset($_POST['validate'])){
    // Vérifier si les champs ne sont pas vide 
    if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['content'])) {
       
        
        // Échapper les données pour éviter les injections 
        $question_title = htmlspecialchars($_POST['title']);
        $question_description = nl2br(htmlspecialchars($_POST['description']));
        $question_content = nl2br(htmlspecialchars($_POST['content']));
        $question_date = date('Y-m-d'); 
        $question_id_author = $_SESSION['id'];
        $question_pseudo_author = $_SESSION['pseudo'];

        // inscrit une question
        $insertQuestionOnWebsite = $bdd->prepare('INSERT INTO questions (titre, description, contenu, id_auteur, pseudo_auteur, date_publication) VALUES (?, ?, ?, ?, ?, ?)');
        
        // Exécutez la requête 
        $insertQuestionOnWebsite->execute(array($question_title, $question_description, $question_content, $question_id_author, $question_pseudo_author, $question_date));
        
        $successMsg = "Votre question a bien été publiée sur le site.";

    } else {
        $errorMsg = "Veuillez compléter tous les champs.";
    }
}
?>

 