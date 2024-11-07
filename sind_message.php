<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=forum', 'root', 'root');
} catch (Exception $e) {
    die('Une erreur a été trouvée : ' . $e->getMessage());
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $recupUser->execute(array($getid));

    if ($recupUser->rowCount() > 0) {
        if (isset($_POST['envoyer'])) {
            $message = htmlspecialchars($_POST['message']);
            $insererMessage = $bdd->prepare('INSERT INTO message (message, id_destinataire, id_auteur) VALUES (?, ?, ?)');
            $insererMessage->execute(array($message, $getid, $_SESSION['id']));
        }
    } else {
        echo "Aucun utilisateur trouvé.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<link rel="stylesheet" href="style.css">
<body>
<?php include 'includes/navbar.php';?>
<br><br>
    <form method="POST" action="">

        <textarea name="message"></textarea>
       
        <br><br>
        <input type="submit" name="envoyer">

        <section id="message">
            <?php
            $recupMessage = $bdd->prepare('SELECT * FROM message WHERE id_auteur = ? AND id_destinataire = ? OR id_auteur = ? AND id_destinataire = ? ');
            $recupMessage->execute(array($_SESSION['id'], $getid,$getid, $_SESSION['id']));
            while ($message = $recupMessage->fetch()) {
             if($message['id_destinataire'] === $_SESSION['id']){
               ?>
               <p style="color : red";><?= $message['message'];?></p>
               <?php
             }elseif($message['id_destinataire'] == $getid){
               ?>
               <p style="color : green";><?= $message['message'];?></p>
               <?php
             }
            }
            ?>
            







        </section>
    </form>
</body>

</html>

