<?php

session_start(); // On commence une session
include("../conf.php"); // On inclut le fichier conf.php qui contient les informations de connexion à la base de données

$id_entreprise = $_GET['id_entreprise']; // On récupère l'id de l'entreprise depuis la requête GET

// On prépare une requête pour récupérer les commandes de l'entreprise ayant un statut "valider"
$sql = $cnx->prepare("SELECT commande.nom_forum,commande.statut,commande.id_commande from commande where id_entreprise='$id_entreprise' && commande.statut='valider'");
$sql->execute();

// Si le formulaire est soumis
if (isset($_POST['submit'])) {

    // Si l'id de la commande n'est pas vide
    if (!empty($_POST['id_commande'])) {

        // On récupère les données du formulaire et on les nettoie
        $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
        $prenom = htmlspecialchars(strtolower(trim($_POST['secteur'])));
        $fonction = htmlspecialchars(strtolower(trim($_POST['ville'])));
        $email = htmlspecialchars(strtolower(trim($_POST['code_postal'])));
        $telephone = htmlspecialchars(strtolower(trim($_POST['telephone'])));
        $id_commande = $_POST['id_commande'];

        // On génère un identifiant unique pour l'exposant
        $uniqueID = uniqid();

        // On prépare une requête pour insérer les données de l'exposant dans la base de données
        $query = $cnx->prepare("INSERT INTO exposants (nom, prenom,fonction,email, telephone,id_entreprise,id_commande,uniqueID) VALUES('$nom', '$prenom', '$fonction', '$email', '$telephone','$id_entreprise','$id_commande','$uniqueID')");

        // Si l'insertion est réussie
        if ($query->execute()) {

            // On prépare une requête pour récupérer les informations de l'exposant nouvellement ajouté
            $sql1 = $cnx->prepare("SELECT * from exposants where uniqueId='$uniqueID'");
            $sql1->execute();
            $info1 = $sql1->fetch(PDO::FETCH_ASSOC);
            $id_exposant = $info1['id_exposant'];
            $_SESSION['id_exposant'] = $info1['id_exposant'];

            // On génère un badge en PDF pour l'exposant
            require_once "../espace_entreprise/generer_pdf_badge.php";
            $nom_pdf = $uniqueID . $fichier;
            $file_location = '../uploads/' . $nom_pdf;
            file_put_contents($file_location, $dompdf->output());

            // On envoie le badge en PDF à l'utilisateur
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $nom_pdf . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($file_location);

            // On met à jour la base de données avec le nom du badge PDF pour l'exposant
            $sql2 = $cnx->prepare("UPDATE exposants set badge='$nom_pdf' where id_exposant='$id_exposant'");
            if ($sql2->execute()) {

                // On redirige l'utilisateur vers la liste des exposants avec un message de succès
                $_SESSION["message"] = "L'exposant a été ajouté avec success !";
                header("Location:exposants.php");
            } else {
                $_SESSION["message"] = "L'ajout de l'exposant à échoué";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- //to close errorMessage -->
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- botstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
  <title>Ajouter un exposant</title>
</head>

<body>

  <div class="home-content">

    <nav class="navbar navbar-light justify-content-center fs-1 mb-5 text-white"
      style="background:linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);">Informations sur l'exposant</nav>
    <div class="container">
      <div class="text-center mb-4">

        <h4>Ajouter un nouveau exposant</h4>
        <p class="text-muted">Completer le formulaire ci-dessous pour ajouter un exposant</p>
      </div>
      <div class="container d-flex justify-content-center">



        <form method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px">

          <?php
                    echo "<select name='id_commande' > ";
                    while ($info = $sql->fetch(PDO::FETCH_ASSOC)) {

                        echo "<option value=$info[id_commande]>" . "commande N°" . $info['id_commande'] . "/" . $info['nom_forum'] . "</option>";
                    }
                    echo "  </SeLect> <br><br>";

                    ?>

          <div class="mb-3">
            <label class="form-label">Nom de l'exposant:</label>
            <input class="form-control" type="text" name="nom" required placeholder="Entrer le nom du client">
          </div>

          <div class="mb-3">
            <label class="form-label">Prenom:</label>
            <input type="text" class="form-control" name="secteur" required placeholder="le secteur de l'entreprise">
          </div>

          <div class="mb-3">
            <label class="form-label">Fonction:</label>
            <input type="text" class="form-control" name="ville" required placeholder="Ville de l'entreprise">
          </div>

          <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="code_postal" required placeholder="Email de l'exposant">
          </div>
          <div class=" mb-3">
            <label class="form-label">Telephone:</label>
            <input type="number" class="form-control" name="telephone" placeholder="Entrer le numero de telephone">

          </div>

          <button type="submit" name="submit" class="btn btn-success btn-lg ">Ajouter</button>






        </form>
      </div>
    </div>
</body>

</html>