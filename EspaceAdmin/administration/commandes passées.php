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
            <th scope="col">Entreprise</th>
            <th scope="col">Statut</th>
            <th scope="col">Admin</th>
            <th scope="col">Forum</th>
            <th scope="col">Date de la commande</th>
            <th scope="col">Total</th>
            <th scope="col">Bon de commande</th>




          </tr>
        </thead>


        <tbody>
          <?php


          $query = $cnx->prepare("SELECT commande.nom_forum,commande.bon_de_commande,commande.total,admin.prenom,commande.id_commande,commande.date_commande,commande.statut,entreprise.id_entreprise,entreprise.nom FROM commande
        inner join entreprise on commande.id_entreprise=entreprise.id_entreprise
        inner join admin on admin.id_admin=commande.id_admin
        where statut is not null
         ");
          $query->execute();

          while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "
          <tr>
          <td><a href='details de la commande.php?id_commande=$data[id_commande]'>$data[id_commande]</td>
          <td><a href='entreprise.php?id_entreprise=$data[id_entreprise]'>$data[nom]</td>
          <td>$data[statut]</td>
          <td>$data[prenom]</td>
          <td>$data[nom_forum]</td>
         <td>$data[date_commande]</td>
         <td>$data[total]</td>
         <td>
         <a class='link-info' href='../administration/telecharger.php?file=$data[bon_de_commande]'><i class='fa-solid fa-download'></i></a>
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
</section>