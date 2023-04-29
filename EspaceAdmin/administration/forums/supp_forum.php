<?php
include("../../conf.php");
session_start();
require("../alert_message.php");
include("../gestion_role.php");
require("../interdit.php");
require("../links.php");

$id_forum = $_GET['id_forum'];
$query1 = $cnx->prepare("DELETE FROM forums_offres WHERE id_forum='$id_forum'");
$query1->execute();



$query2 = $cnx->prepare("DELETE FROM forum WHERE id_forum='$id_forum'");
if ($query2->execute()) {
    setcookie('message' , "Le forum a été bien supprimé" , time() + ALERT_EXPIRE_TIME) ;
    header("Location:forums.php");
    exit ;
}