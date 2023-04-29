<?php
include("../../conf.php");
session_start();
include("../gestion_role.php");
require("../interdit.php");
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
  <title>Catégorie</title>
</head>

<body id="body-pd" class="bg-gray-100 body-pd">
  <?php include($path_pref . "side_bar/side_bar.php") ?>

  <!--Container Main start-->
  <div class="height-100 bg-light">
  <?php include($path_pref . "alerts.php") ?>
    <div class="home-content">
      <div class="container">
        <a href="ajouter_catégorie.php" class="btn btn-outline-info mb-3" style=" border: 1px solid 	#00bfff  ;">+ Nouvelle
          catégorie</a>
        <div class="table-responsive">
          <table class="table table-striped table-hover text-center " id="myTable">
            <thead class="table-dark ">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom de la Catégorie</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = $cnx->prepare("SELECT * FROM type_offre ");
              $query->execute();
              while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "
                    <tr>
                      <td>$data[id_type_offre]</td>
                      <td>$data[nom_type]</td>
                      <td>
                      <a class='link-info' href='modif_catégorie.php?id_type_offre=$data[id_type_offre]'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
                      <a class='link-dark' style='border:0;' class='fa-solid fa-trash fs-5 me-3' href='supp_catégorie.php?id_type_offre=$data[id_type_offre]'><span class='fa-solid fa-trash fs-5 me-3'></span></a>           
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



