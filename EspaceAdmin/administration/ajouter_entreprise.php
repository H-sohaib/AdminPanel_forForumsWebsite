<?php

session_start();
include("../conf.php");
include("gestion_role.php");

require("interdit.php");


if (isset($_POST['submit'])) {
    if (!empty($_POST['nom']) && !empty($_POST['secteur']) && !empty($_POST['ville'])) {

        $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
        $secteur = htmlspecialchars(strtolower(trim($_POST['secteur'])));
        $ville = htmlspecialchars(strtolower(trim($_POST['ville'])));
        $code_postal = htmlspecialchars(strtolower(trim($_POST['code_postal'])));
        $adresse = htmlspecialchars(strtolower(trim($_POST['adresse'])));
        $telephone = htmlspecialchars(strtolower(trim($_POST['telephone'])));



        $logo = $_FILES['file'];


        $uniqueID = uniqid();
        $logo_name = $uniqueID . $logo['name'];
        $logo_tmp = $logo['tmp_name'];
        $logo_size = $logo['size'];

        if ($logo_size < 5 * 1024 * 1024) {
            $query = $cnx->prepare("INSERT INTO entreprise (nom, secteur, ville, code_postal, adresse, telephone,logo) VALUES('$nom', '$secteur', '$ville', '$code_postal', '$adresse', '$telephone','$logo_name')");
            move_uploaded_file($logo_tmp, "../uploads/{$logo_name}");
        }

        if ($query->execute()) {
            $_SESSION["message"] = "Entreprise crée avec success !";
            header("Location: entreprises.php");
            exit(0);
        } else {
            $_SESSION["message"] = "L'ajout de l'entreprise à échoué";
            header("Location:entreprises.php");
            echo "d";
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
  <title>Ajouter une entreprise</title>
</head>

<body>
  <div class="home-content">
    <nav class="navbar navbar-light justify-content-center fs-1 mb-5 text-white"
      style="background:linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);">
      Informations sur l'entreprise
    </nav>
    <div class="container">
      <div class="text-center mb-4">
        <h4>Ajouter une nouvelle entreprise</h4>
        <p class="text-muted">Completer le formulaire ci-dessous pour ajouter une entreprise</p>
      </div>
      <div class="container d-flex justify-content-center">



        <form method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px">

          <div class="mb-3">
            <label class="form-label">Nom de l'entreprise:</label>
            <input class="form-control" type="text" name="nom" required placeholder="Entrer le nom du client">
          </div>

          <div class="mb-3">
            <label class="form-label">Secteur:</label>
            <input type="text" class="form-control" name="secteur" required placeholder="le secteur de l'entreprise">
          </div>

          <div class="mb-3">
            <label class="form-label">Ville:</label>
            <input type="text" class="form-control" name="ville" required placeholder="Ville de l'entreprise">
          </div>

          <div class="mb-3">
            <label class="form-label">Code postal:</label>
            <input type="number" class="form-control" name="code_postal" required placeholder="Code postal de la ville">
          </div>

          <div class="mb-3">
            <label class="form-label">Adresse:</label>
            <input type="text" class="form-control" name="adresse" placeholder="Entrer le pays du client" required>
          </div>

          <div class=" mb-3">
            <label class="form-label">Telephone:</label>
            <input type="number" class="form-control" name="telephone" placeholder="Entrer le numero de telephone">
          </div>

          <div class="mb-3">
            <label class="form-label">Logo de l'entreprise:</label>
            <input type="file" name="file">
          </div>

          <button type="submit" name="submit" class="btn btn-success btn-lg ">Ajouter</button>

        </form>
      </div>
    </div>
</body>

</html>