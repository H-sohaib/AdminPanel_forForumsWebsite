<?php
// Démarrer la session pour pouvoir accéder aux variables de session
session_start();
// Inclure le fichier de configuration de la base de données
include("../conf.php");

// Vérifier si le formulaire a été soumis
if ((isset($_POST['submit']))) {
    // Vérifier si les champs requis sont remplis
    if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        // Nettoyer et filtrer les données soumises par le formulaire
        $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
        $prenom = htmlspecialchars(strtolower(trim($_POST['prenom'])));
        $fonction = htmlspecialchars(strtolower(trim($_POST['fonction'])));
        $email = htmlspecialchars(strtolower(trim($_POST['email'])));
        $telephone = htmlspecialchars(strtolower(trim($_POST['telephone'])));
        $verify = "1";

        // Hacher le mot de passe soumis pour des raisons de sécurité
        $password = htmlspecialchars(strtolower(trim($_POST['password'])));
        $cpassword = htmlspecialchars(strtolower(trim($_POST['cpassword'])));
        $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Insérer les données soumises dans la table 'responsable'
        $query = $cnx->prepare("INSERT INTO responsable (nom, prenom,fonction,email, telephone,PASSWORD,verify) VALUES('$nom', '$prenom', '$fonction', '$email', '$telephone','$password_hashed','$verify')");
        // Exécuter la requête d'insertion et vérifier si elle s'est bien déroulée
        if ($query->execute()) {
            // Récupérer l'id du responsable ajouté
            $sql = $cnx->prepare("SELECT * from responsable where nom='$nom' && prenom='$prenom' && fonction='$fonction' && email='$email' && telephone='$telephone' && PASSWORD='$password_hashed'");
            $sql->execute();
            $info = $sql->fetch(PDO::FETCH_ASSOC);
            $id_responsable = $info['id_responsable'];

            // Mettre à jour la table 'entreprise' avec l'id du responsable ajouté
            $query1 = $cnx->prepare("UPDATE entreprise set id_responsable='$id_responsable'");
            // Vérifier si la mise à jour a été effectuée avec succès
            if ($query1->execute()) {
                // Enregistrer un message de succès dans les variables de session
                $_SESSION["message"] = "L'ajout du responsable est effectué avec succes";
                // Rediriger vers la page entreprises.php
                header("location:entreprises.php");
            } else {
                // Enregistrer un message d'erreur dans les variables de session
                $_SESSION["message"] = "L'ajout du responsable à échoué";
            }
        } else {
            // Enregistrer un message d'erreur dans les variables de session
            $_SESSION["message"] = "L'ajout du responsable à échoué";
            // Rediriger vers la page entreprises.php
            header("location:entreprises.php");
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

        <h4>Ajouter un responsable</h4>
        <p class="text-muted">Completer le formulaire ci-dessous pour ajouter un exposant</p>
      </div>
      <div class="container d-flex justify-content-center">



        <form method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px">


          <div class="mb-3">
            <label class="form-label">Nom du responsable:</label>
            <input class="form-control" type="text" name="nom" required placeholder="Entrer le nom du client">
          </div>

          <div class="mb-3">
            <label class="form-label">Prenom:</label>
            <input type="text" class="form-control" name="secteur" required placeholder="le secteur de l'entreprise">
          </div>

          <div class="mb-3">
            <label class="form-label">Fonction:</label>
            <input type="text" class="form-control" name="fonction" required placeholder="Ville de l'entreprise">
          </div>

          <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" required placeholder="Email de l'exposant">
          </div>
          <div class=" mb-3">
            <label class="form-label">Telephone:</label>
            <input type="number" class="form-control" name="telephone" placeholder="Entrer le numero de telephone">

          </div>
          <div class=" mb-3">
            <label class="form-label">Mot de passe:</label>
            <input type="password" placeholder="Mot de passe" name="password" required />
          </div>

          <div class=" mb-3">
            <label class="form-label">Confirmation du mot de passe:</label>
            <input type="password" placeholder="Confirmer" name="cpassword" required />
          </div>

          <button type="submit" name="submit" class="btn btn-success btn-lg ">Ajouter</button>






        </form>
      </div>
    </div>
</body>

</html>