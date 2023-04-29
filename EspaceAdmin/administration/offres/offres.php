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
  <title>Offres</title>
</head>

<body>
  <?php include($path_pref . "side_bar/side_bar.php") ?>  
  <!-- Container Main start -->
  <div class="height-100 bg-light">
    <?php include($path_pref . "alerts.php") ?>
    <div class="home-content">
      <div class="container">
        <a href="ajouter_offre.php" class="btn btn-outline-info mb-3" style=" border: 1px solid 	#00bfff  ;">+ Nouvelle
          offre</a>

        <div class="table-responsive">
          <table class="table table-striped table-hover text-center " id="myTable">
            <thead class="table-dark ">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom </th>
                <th scope="col">Descrription</th>
                <th scope="col">disponible</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Visible</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Action</th>

              </tr>
            </thead>


            <tbody>
              <?php
              $query = $cnx->prepare(

                "SELECT * FROM type_offre
            inner join offre on offre.id_type_offre=type_offre.id_type_offre
          "
              );
              $query->execute();

              //read data of each row
              while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "
          <tr>
          <td>$data[id_offre]</td>
          <td>$data[nom]</td>
          <td>$data[description]</td>";
                echo "<td>";
                if ($data['disponible'] == 0) {
                  echo "non";
                } else {
                  echo "oui";
                }
                echo "</td>";
                echo   "<td>$data[prix_unitaire]€</td>";
                echo "<td>";
                if ($data['visible'] == 0) {
                  echo "non";
                } else {
                  echo "oui";
                }
                echo   "<td>$data[nom_type]</td>";
                echo "</td>
     <td>
            <a class='link-info' href='modif_offre.php?id_offre=$data[id_offre]'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
            <a class='link-dark' style='border:0;' class='fa-solid fa-trash fs-5 me-3' href='supp_offre.php?id_offre=$data[id_offre]'><span class='fa-solid fa-trash fs-5 me-3'></span></a>           
            
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