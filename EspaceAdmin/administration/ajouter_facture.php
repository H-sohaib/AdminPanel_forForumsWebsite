<?php
include("../conf.php");

// Récupération de l'id de l'entreprise depuis l'URL
$id_entreprise = $_GET['id_entreprise'];

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {

  // Récupération des informations du fichier
  $file = $_FILES['file'];
  $uniqueId = uniqid();
  $file_name = $uniqueId . $file['name'];
  $file_tmp = $file['tmp_name'];
  $file_size = $file['size'];

  // Nettoyage et récupération de la description depuis le formulaire
  $description = htmlspecialchars(strtolower(trim($_POST['description'])));

  // Récupération de l'id de la commande depuis le formulaire
  $id_commande = $_POST['id_commande'];

  // Vérification si la taille du fichier est inférieure à 5 Mo
  if ($file_size < 5 * 1024 * 1024) {

    // Préparation de la requête SQL pour l'insertion de la facture dans la base de données
    $query = $cnx->prepare("INSERT INTO facture (nom_facture,size,description,id_entreprise,id_commande) VALUES ('$file_name','$file_size','$description','$id_entreprise','$id_commande')");
  } else {
    echo "la taille est trop grande";
  }

  // Déplacement du fichier uploadé vers un emplacement spécifié
  move_uploaded_file($file_tmp, "../uploads/{$file_name}");

  // Exécution de la requête SQL pour l'insertion de la facture dans la base de données
  if ($query->execute()) {
    $_SESSION["message"] = "La facture a été ajouté avec success !";
    header("Location: entreprises.php");
  } else {
    $_SESSION["message"] = "La facture n'a pas été ajouté !";
    header("Location: entreprises.php");
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
  <title>Ajouter une facture</title>
</head>

<body>

  <div class="home-content">

    <nav class="navbar navbar-light justify-content-center fs-1 mb-5 text-white"
      style="background:linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);">Informations sur la facture</nav>
    <div class="container">
      <div class="text-center mb-4">

        <h4>Ajouter une facture</h4>
        <p class="text-muted">Completer le formulaire ci-dessous pour Ajouter une facture</p>
      </div>
      <div class="container d-flex justify-content-center">


        <form method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
          <div class="mb-3">
            <label class="form-label">Description:</label>
            <input type="text" name="description" placeholder="Description de la facture">
          </div>
          <div class="mb-3">
            <label class="form-label">La commande:</label>
            <?php
            $sql = $cnx->prepare("SELECT commande.id_commande,commande.nom_forum from commande
          
            
            
            where statut='valider' && id_entreprise='$id_entreprise' &&  commande.id_commande NOT IN (SELECT id_commande FROM facture);");
            $sql->execute();
            echo "<select name='id_commande' > ";
            while ($info = $sql->fetch(PDO::FETCH_ASSOC)) {

              echo "<option value=$info[id_commande]>" . "commande N°" . $info['id_commande'] . "/" . $info['nom_forum'] . "</option>";
            }
            echo "  </SeLect> <br><br>";


            ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Votre facture:</label>
            <input type="file" name="file">
          </div>
          <button type="submit" name="submit" class="btn btn-success btn-lg ">Ajouter la facture</button>
        </form>
      </div>
    </div>
</body>

</html>