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
            <th scope="col">Forum</th>
            <th scope="col">Statut</th>
            <th scope="col">Date de la commande</th>
            <th scope="col">Bon de commande</th>

            <th scope="col">Bon de commande signé</th>
            <th scope="col">Action</th>
          </tr>
        </thead>


        <tbody>
          <?php


          $query = $cnx->prepare("SELECT commande.nom_forum,commande.id_commande,commande.date_commande,commande.statut,entreprise.id_entreprise,entreprise.nom,commande.bon_de_commande,commande.bon_de_commande_signee FROM commande
        inner join entreprise on commande.id_entreprise=entreprise.id_entreprise
        where statut is null
         ");
          $query->execute();






          //read data of each row
          while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "
          <tr>
          <td><a href='details de la commande.php?id_commande=$data[id_commande]'>$data[id_commande]</td>
          <td><a href='entreprise.php?id_entreprise=$data[id_entreprise]'>$data[nom]</td>

          <td>$data[nom_forum]</td>";
            if ($data['statut'] == null) {
              echo "<td>
                  en attente
            </td>
          
         
        ";
            }


            echo "<td>$data[date_commande]</td>";
            if (isset($data['bon_de_commande'])) {
              echo "   <td>
          <a class='link-info' href='../administration/telecharger.php?file=$data[bon_de_commande]'><i class='fa-solid fa-download'></i></a>
          </td>";
            } else {
              echo "<td>Non renseigner</td>";
            }
            if (isset($data['bon_de_commande_signee'])) {
              echo "   <td>
         <a class='link-info' href='../administration/telecharger.php?file=$data[bon_de_commande_signee]'><i class='fa-solid fa-download'></i></a>
         </td>";
            } else {
              echo "<td>Non renseigner</td>";
            }
            echo   "<td>
         <a class='link-dark' style='border:0; margin-right:15px' class='fa-solid fa-trash fs-5 me-3' href='valider_commande.php?action=valider&id_commande=$data[id_commande]'><span class='fa-solid fa-clipboard-check'</span></a>           
         <a class='link-dark' style='border:0;' class='fa-solid fa-trash fs-5 me-3' href='valider_commande.php?action=refuser&id_commande=$data[id_commande]'><span class='fa-solid fa-xmark'></span></a>           

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