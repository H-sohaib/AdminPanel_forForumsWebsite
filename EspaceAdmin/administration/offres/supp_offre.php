<?php
include("../../conf.php");
session_start();
include("../gestion_role.php");
require("../alert_message.php");
require("../interdit.php");
require("../links.php");

$id_offre=$_GET['id_offre'];
$query =$cnx->prepare("DELETE FROM forums_offres WHERE id_offre='$id_offre'") ;
$query->execute();
$query1 =$cnx->prepare("DELETE FROM offre WHERE id_offre='$id_offre'") ;
if($query1->execute()){
    setcookie('message' , "L'entreprise a été bien supprimé" , time() + ALERT_EXPIRE_TIME) ;
    header("Location:offres.php");
    exit ; 
}