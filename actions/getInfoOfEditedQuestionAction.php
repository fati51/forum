<?php
session_start();
require('actions/database.php');
//récupere les question par son ID 
if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $idOfQuestion = $_GET['id'];
    $checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfQuestion));

    if ($checkIfQuestionExists->rowCount() > 0) {
        $questionInfo = $checkIfQuestionExists->fetch();
        // Vérifie si l'utilisateur est l'auteur de la question
        if ($questionInfo['id_auteur'] == $_SESSION['id']) {

            $question_title = $questionInfo['titre']; 
            $question_description = $questionInfo['description'];
            $question_content = $questionInfo['contenu'];
           //supprime les balise html
            $question_description = str_replace('<br />', '', $question_description);
            $question_content = str_replace('<br />', '', $question_content);
        } else {
            $errorMsg = "Vous n'êtes pas l'auteur de cette publication";
        }
    } else {
        $errorMsg = "Aucune question n'a été trouvée";
    }
} else {
    $errorMsg = "Aucune question n'a été trouvée";
}
?>

