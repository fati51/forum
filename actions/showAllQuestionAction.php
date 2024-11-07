<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require('actions/database.php');
$getAllQuestions = $bdd->query('SELECT id, id_auteur, titre, description, pseudo_auteur, date_publication FROM questions ORDER BY id DESC LIMIT 0, 5');

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $userSearch = $_GET['search'];

    // Utilisation de guillemets simples pour encadrer la requête SQL et de guillemets doubles pour le LIKE
    $query = "SELECT  * FROM questions WHERE titre LIKE '%$userSearch%' ORDER BY id DESC";
    $getAllQuestions = $bdd->query($query);
}
?>
