<?php
include("../conf.php");
session_start();
include("gestion_role.php");

include("interdit.php");

$action=$_GET['action'];
$id_commande=$_GET['id_commande'];



$query=$cnx->prepare("UPDATE commande set statut='$action',id_admin='$_SESSION[id_admin]' where id_commande='$id_commande'");
if($query->execute()){
    $_SESSION['message']="la commande a été ".$action." avec success";
    $_SESSION['mail_message']="Votre commande a été bien accepté";
   // include("envoie_mail.php");
    header("Location:commandes.php");
   
}else{
    echo "la validation de la commande a échoué";
    header("Location:commandes.php");

   
}



?>