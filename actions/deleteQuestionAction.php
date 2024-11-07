<?php
session_start();
 

if (!isset($_SESSION['auth'])) {
    header('Location: ../login.php');
    exit(); 
}

require('./database.php');
//recupere l ID de la question 
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idOfTheQuestion = $_GET['id'];
    $checkIfQuestionExists = $bdd->prepare('SELECT id_auteur FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfTheQuestion)); 
    //vérifee c est il deja une question 
    if ($checkIfQuestionExists->rowCount() > 0) {
       $questionsInfos = $checkIfQuestionExists->fetch(); 
        // Vérifie si l'utilisateur est l'auteur de la question
       if ($questionsInfos['id_auteur'] == $_SESSION['id']) {
        //la requete pour la supp
           $deleteThisQuestion = $bdd->prepare('DELETE FROM questions WHERE id = ?');
           $deleteThisQuestion->execute(array($idOfTheQuestion));
    
           header('Location: ../my-question.php');
           exit(); 
       } else {
           echo "Vous n'avez pas le droit de supprimer cette question !";
       }
    } else {
        echo "Aucune question n'a été trouvée";
    }
} else {
    echo "Aucune question n'a été trouvée";
}
?>
