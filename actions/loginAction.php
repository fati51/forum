<?php 
//demarre une session 
session_start();
require ('actions/database.php');
//Vérifie si le formulaire a été soumis.
if(isset($_POST['validate'])){

    //Récupere et sécurise les donnes
    if(!empty($_POST['pseudo']) && !empty($_POST['password'])) {
   
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['password']);
          //vérifee c est l'utlisateur il exciste 
       $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?  ');
       $checkIfUserExists->execute(array($user_pseudo));
        // Si un utilisateur avec le pseudo donné est trouvé
       if($checkIfUserExists->rowCount()> 0){

           // Récupère les informations de l'utilisateur
        $userInfos = $checkIfUserExists->fetch();
        //vérifee c'est le mode passe correspond bien au mode passe qui se trouve donne la base de donnees 
        if(password_verify($user_password, $userInfos['mdp'])){
           
       //ouvrir des sessions pour l 'authentification 
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userInfos['id'];
            $_SESSION['lastname'] = $userInfos['nom'];
            $_SESSION['firstname'] = $userInfos['prenom'];
            $_SESSION['pseudo'] = $userInfos['pseudo'];
           

            header('Location: index.php');

        }else{
            $errorMsg = "votre mode passe est incoorect   ";
        }

       }else{
        $errorMsg = "votre pseudo est incorrect ";
       }

    
    } else {
        $errorMsg = "Veuillez remplir tous les champs.";
    }
}
