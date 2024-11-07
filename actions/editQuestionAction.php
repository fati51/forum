<?php
session_start();
require('actions/database.php');
//vérifee et sécurise le formulaire
if (isset($_POST['validate'])) {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['content'])) {
        $new_question_title = htmlspecialchars($_POST['title']);
        $new_question_description = htmlspecialchars($_POST['description']);
        $new_question_content = htmlspecialchars($_POST['content']);

        // modiféé la question 
        $editQuestionOnWebsite = $bdd->prepare('UPDATE questions SET titre = ?, description = ?, contenu = ? WHERE id = ?');
        $editQuestionOnWebsite->execute(array($new_question_title, $new_question_description, $new_question_content, $idOfQuestion));

        header('Location: my-question.php');
        exit();
    } else {
        $errorMsg = "Veuillez compléter tous les champs....";
    }
}
?>


