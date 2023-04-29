<?php

include("../conf.php");
session_start();
include("gestion_role.php");
require("slide.php");
require("alert_message.php");
require("interdit.php");

?>

<div class="home-content">
  <div class="container">

    <div class="table-responsive">
      <table class="table table-striped table-hover text-center " id="myTable">
        <thead class="table-dark ">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Id commande</th>
            <th scope="col">Id offre</th>
            <th scope="col">Nom de l'offre</th>
            <th scope="col">Prix unitaire</th>


          </tr>
        </thead>


        <tbody>
          <?php
          $id_commande = $_GET['id_commande'];

          $query = $cnx->prepare("SELECT * FROM archive_details_commandes where id_commande='$id_commande' ");
          $query->execute();


          while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

            echo "
          <tr>
          <td>$data[id_archive_details_commande]</td>
               
          <td>$data[id_commande]</td>
                
          <td>$data[id_offre]</td>
                
          <td>$data[nom_offre]</td>
    

          <td>$data[prix_unitaire]€</td>";
          }

          ?>


        </tbody>
      </table>
    </div>

  </div>


</div>
</section>