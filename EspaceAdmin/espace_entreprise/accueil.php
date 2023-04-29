
<?php
include("../conf.php");
session_start();
include("alert_message.php");
include("side.php");
$id_responsable=$_SESSION['id_responsable'];
$sql=$cnx->prepare("SELECT * from entreprise where id_responsable='$id_responsable'");
$sql->execute();
if($info=$sql->fetch(PDO::FETCH_ASSOC)){
    $_SESSION['id_entreprise']=$info['id_entreprise'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Informations générales</title>
   <link rel="stylesheet" href="accueil.css">

   <!-- Link to Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <style>
      /* Custom styles for this page */
      .section-text {
         padding: 1rem;
      }
      .section-image {
         display: flex;
         justify-content: center;
         align-items: center;
      }
   </style>
</head>
<body>
   <div class="one">

  
   <div class="container" id="two">

 
   <section class="first row" id="first">
      <div class="col-md-6 order-md-1 section-image" >
         <img src="images/FTT.jpg" class="img-fluid">
      </div>
      <div class="col-md-6 order-md-1  section-text">
         <h2>Qu'est ce que le Forum Toulouse Technologies ?</h2>
         <p>Organisé depuis 1991 par des étudiants et jeunes diplômés bénévoles, le forum réunit chaque année environ 70 entreprises et 2 000 visiteurs principalement étudiants.</p>
         <p>Suite à la crise sanitaire le FTT a créé une Alliance avec l'association Stratégie Karrière afin d'accompagner les entreprises dans leurs démarches de recrutement et développement de leurs marques employeurs.</p>
      </div>
   </section>
   </div>
   <div class="container" id="two">
   <section class="second row" id="first">
      <div class="col-md-6 order-md-2 section-image">
         <img src="images/FTT2.png" class="img-fluid">
      </div>
      <div class="col-md-6 order-md-1 section-text">
         <h2>Qu'est ce que le Forum Data & Security ?</h2>
         <p>Le Forum Data & Security (DNS) est un engagement de trois associations : ASK, SECUSEED et FTT pour apporter une solution pragmatique au problème de pénuries de compétences en matière de la cybersécurité et la data.</p>

<p>L’association FTT a 31 ans de salons en faveur de l’emploi, de la formation et de l’insertion. L’association ASK et SECUSEED fédèrent et accompagnent respectivement les compétences du marché de la data et la cyber sécurité...</p>
      </div>
   </section>
   </div>
   
   </div>
   <!-- Link to Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJ
