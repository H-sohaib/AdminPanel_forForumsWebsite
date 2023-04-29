<?php
// inclure le fichier de configuration
include("../conf.php");
session_start();

// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {
  $id_commande=$_GET['id_commande'];
  $file = $_FILES['file'];
  $uniqueId=uniqid();
  $file_name = $uniqueId.$file['name'];
  $file_tmp = $file['tmp_name'];
  $file_size = $file['size'];

  // Vérifier si la taille de la photo est inférieure à 5 Mo
  if($file_size<5*1024*1024){
    // Préparer la requête pour mettre à jour le bon de commande signé dans la base de données
    $query =$cnx->prepare( "UPDATE commande set bon_de_commande_signee='$file_name' where id_commande='$id_commande'");
  } else{
    $_SESSION['message_e']="la taille de la photo est trop grande";
    header("location:mes commandes.php");
  }

  // Déplacer le fichier téléchargé vers l'emplacement spécifié
  move_uploaded_file($file_tmp, "../uploads/{$file_name}");

  // Exécuter la requête
  if ( $query->execute()) {
    $_SESSION["message"]="Le bon de commande signé a été ajouté avec success !";
    header("Location: mes commandes.php");
  } else {
    $_SESSION["message"]="Le bon de commande n'a pas été ajouté !";  
    header("Location: mes commandes.php");
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
    <!-- Boxicons -->
  <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- botstrap-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <title>Ajouter le bon de commande</title>
</head>

<body>
    
<div class="home-content">

      <nav class="navbar navbar-light justify-content-center fs-1 mb-5 text-white" style="background:linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);" >Rensignez le bon de commande signé</nav>
<div class="container">
  <div class="text-center mb-4">
   
    <h4>Ajouter le bon de commande</h4>
    <p class="text-muted">Completer le formulaire ci-dessous pour Ajouter le bon de commande</p>
  </div>
  <div class="container d-flex justify-content-center">

    
  <form method="POST" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
           

            <div class="mb-3">
                <label class="form-label">Votre Bon de commande signé:</label>
                <input type="file" name="file">
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-lg ">Ajouter le bon de commande</button></form>
    </div>
</div>
</body>
</html>