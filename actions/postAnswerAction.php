<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum', 'root', 'root');
} catch (Exception $e) {
    die('Une erreur a été trouvée : ' . $e->getMessage());
}

if (isset($_POST['validate'])) {
    if (!empty($_POST['answer'])) {
        $user_answer = nl2br(htmlspecialchars($_POST['answer']));
        $insertAnswer = $bdd->prepare('INSERT INTO answers (id_auteur, pseudo_auteur, id_question, contenu) VALUES (?, ?, ?, ?)');
        $insertAnswer->execute(array($_SESSION['id'], $_SESSION['pseudo'],  $idOfTheQuestion, $user_answer));
    }
}
?>
