<?php
use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';
include("../conf.php");
session_start();


$id_responsable=$_SESSION['id_responsable'];
$query1=$cnx->prepare("SELECT entreprise.nom,entreprise.adresse,entreprise.code_postal,entreprise.ville,responsable.nom as nom_responsable,responsable.prenom,responsable.fonction,responsable.email,responsable.telephone from entreprise 
inner join responsable on entreprise.id_responsable=responsable.id_responsable
where responsable.id_responsable='$id_responsable'");
$query1->execute();
$data1=$query1->fetch(PDO::FETCH_ASSOC);

$query2=$cnx->prepare("SELECT * from adresse_facturation where id_responsable='$id_responsable'");
$query2->execute();
$data2=$query2->fetch(PDO::FETCH_ASSOC);

$query4=$cnx->prepare("SELECT * from forum
where id_forum='$id_forum'");
$query4->execute();
$data4=$query4->fetch(PDO::FETCH_ASSOC);




ob_start();
include("generer_info_entreprise.php");
$html=ob_get_contents();
ob_clean();



$dompdf=new Dompdf();
$dompdf->loadhtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$fichier='bon-de-commande.pdf';
$dompdf->stream($fichier);

 
?>