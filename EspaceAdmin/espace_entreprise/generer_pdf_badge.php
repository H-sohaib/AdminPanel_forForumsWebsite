<?php
use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';
include("../conf.php");
session_start();






ob_start();
include("generer_info_exposant.php");
$html=ob_get_contents();
ob_clean();



$dompdf=new Dompdf();
$dompdf->loadhtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$fichier='badge-exposant.pdf';
$dompdf->stream($fichier);




 
?>