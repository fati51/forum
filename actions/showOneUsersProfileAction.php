<?php
session_start();
require('actions/database.php');

if(isset($_GET['id']) AND !empty($_GET['id']) ){
$idOfUser = $_GET['id'];
$checkIfUserExists = $bdd->prepare('SELECT pseudo,nom, prenom FROM users WHERE id=? ');
$checkIfUserExists->execute(array($idOfUser));

if($checkIfUserExists->rowCount()>0){
    $usersInfos = $checkIfUserExists->fetch();
    $user_pseudo =$usersInfos['pseudo'];
    $user_lastname =$usersInfos['nom'];
    $user_firstname =$usersInfos['prenom'];

   $getHisQuestion = $bdd->prepare('SELECT *FROM questions WHERE id_auteur = ?  ');
   $getHisQuestion->execute(array($idOfUser));
    

   


}else{
    $errorMsg = "Aucun utlisateur trouvé ";
}


}else{
    $errorMsg = "Aucun utlisateur trouvé ";
}