<?php
try{
   
    $bdd = new PDO('mysql:host=localhost;dbname=forum', 'root', 'root');
 
}catch(Exception $e){
 die(' une erreur à été trouve :'.$e->getMessage()); 
}
