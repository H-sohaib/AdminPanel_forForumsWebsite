<?php
include("../../conf.php");
session_start();
include("../gestion_role.php");
require("../interdit.php");
require("../links.php");

$id_type_offre = $_GET['id_type_offre'];
$query1 = $cnx->prepare("DELETE FROM forums_offres
WHERE id_offre IN (
SELECT id_offre FROM offre
WHERE id_offre IN (
 Select id_offre from offre
 WHERE id_type_offre ='$id_type_offre'))");

$query2 = $cnx->prepare("DELETE from offre where id_type_offre='$id_type_offre'");
$query3 = $cnx->prepare("DELETE FROM type_offre WHERE id_type_offre='$id_type_offre'");
$query1->execute();
$query2->execute();
if ($query3->execute()) {
    setcookie('message', "La catégorie a été bien supprimé", time() + ALERT_EXPIRE_TIME);
    header("Location:catégorie.php");
    exit;
}
