
<?php 
//demarre une session 
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=test','root','root');
}catch(Exception $e){
    die ("Veuillez vérifée votre base de donnee: ".$e->getMessage());
}
//Vérifie si le formulaire a été soumis.
if(isset($_POST['valider'])){
  //Récupere et sécurise les donnes
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty('firstname') AND !empty($_POST['password'])){
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      //vérifee c est l'utlisateur il exciste 
       $user_execite = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ? ');
       $user_execite->execute(array($user_pseudo));
       // inscrit l 'utlisateur c 'est il pas sur le site 
       if($user_execite->rowCount() == 0){
       $add_user= $bdd->prepare('INSERT INTO users(pseudo,nom,prenom,mdp) VALUES (?,?,?,?)');
       $add_user->execute(array($user_pseudo,$user_lastname,$user_firstname,$user_password));
       // récupere les identifant des nouveaux utilisateurs 
       $userrecup = $bdd->prepare('SELECT id FROM users WHERE pseudo = ? AND  nom = ? AND prenom =?');
       $userrecup->execute(array($user_pseudo,$user_firstname,$user_lastname));

       //ouvrir des sessions pour l 'authentification 
       $userInfo = $userrecup->fetch();
       $_SESSION['auth'] = true;
       $_SESSION['id'] = $userInfo['id'];
       $_SESSION['lastname'] = $userInfo['nom'];
       $_SESSION['firstname'] = $userInfo['prenom'];
       $_SESSION['pseudo'] = $userInfo['pseudo'];



       }





    }
}else {
  $errorMsg = 'Veuillez remplir tous les champs....';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
 <form class="container" method="POST">
  
   
  
 <div class="form-group">
   <label for="exampleInputEmail1">Pseudo</label>
   <input type="text" class="form-control" name="pseudo">
  
 </div>
 <div class="form-group">
   <label for="exampleInputEmail1">nom</label>
   <input type="text" class="form-control" name="lastname">
  
 </div>
 
 <div class="form-group">
   <label for="exampleInputEmail1">Prenom</label>
   <input type="text" class="form-control" name="firstname">
  
 </div>
 
 
 
 
 <div class="form-group">

   <label for="exampleInputPassword1">Password</label>
   <input type="password" class="form-control" name="password">
 </div>
 
 <button type="submit" class="btn btn-primary"name="valider">connecter</button>
 <br></br>
 <a href="login.php"><p>J'ai déja un compte je me connecte </p></a>

</form>
    
</body>
</html>
