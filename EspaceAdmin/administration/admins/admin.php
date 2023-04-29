<?php
// Inclure les fichiers nécessaires
include("../../conf.php"); // Configuration de la base de données
session_start(); // Démarrer une session
require("../interdit.php"); // Vérifier si l'utilisateur a le droit d'accéder à la page
include("../gestion_role.php"); // Fonctions pour la gestion des rôles
require("../links.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  // include commun css link
  require($path_pref . "head_links.php");
  // include depencease of side bar 
  require($path_pref . "side_bar/side_link.php");
  ?>
  <title>Admin</title>
</head>

<body id="body-pd" class="bg-gray-100 body-pd">
  <?php include($path_pref . "side_bar/side_bar.php") ?>
  <!--Container Main start-->
  <div class="height-100 bg-light">
    <div class="home-content">
      <div class="container">
        <!-- Lien pour ajouter un nouvel administrateur -->
        <a href="ajouter_admin.php" class="btn btn-outline-info mb-3" style=" border: 1px solid 	#00bfff  ;">
          + Nouveau admin</a>
        <div class="table-responsive">
          <!-- Tableau pour afficher les données des administrateurs -->
          <table class="table table-striped table-hover text-center" id="myTable">
            <thead class="table-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Description du role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Requête SQL pour récupérer les données des administrateurs
              $query = $cnx->prepare("SELECT admin.id_admin,admin.nom,admin.prenom,admin.email,role.niveau as nom_role,role.description FROM admin INNER JOIN role ON role.id_role=admin.id_role");
              $query->execute();
              // Boucle pour afficher les données des administrateurs dans le tableau
              while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "
            <tr>
              <td>$data[id_admin]</td>
              <td>$data[nom]</td>
              <td>$data[prenom]</td>
              <td>$data[email]</td>
              <td>$data[nom_role]</td>
              <td>$data[description]</td>
              <td>
                <!-- Lien pour modifier les données de l'administrateur -->
                <a class='link-info' href='" . $base_url . "admins/modif_admin.php?id_admin=$data[id_admin]'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
              </td>
            </tr>
            ";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php
  include($path_pref . "side_bar/side_script.php");
  include($path_pref . "js_scripts.php");
  ?>
</body>

</html>