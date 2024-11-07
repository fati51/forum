<?php

require('actions/database.php');

$getAllAnswersOfThisQuestion = $bdd->prepare('SELECT * FROM answers WHERE id_question = ? ORDER BY id DESC ');
$getAllAnswersOfThisQuestion->execute(array($idOfTheQuestion));