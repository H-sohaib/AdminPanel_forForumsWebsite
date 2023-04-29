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

            <th scope="col">Id commande</th>
            <th scope="col">Nom de l'entreprise</th>
            <th scope="col">Nom du forum</th>
            <th scope="col">Date de la commande</th>
            <th scope="col">Statut</th>
            <th scope="col">Admin</th>
            <th scope="col">Total</th>


          </tr>
        </thead>


        <tbody>
          <?php

          $query = $cnx->prepare("SELECT * FROM archive_commande ");
          $query->execute();


          while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "
          <tr>  
          <td><a href='archive details commandes.php?id_commande=$data[id_commande]'>$data[id_commande]</td>
                
          <td>$data[nom_entreprise]</td>
                
          <td>$data[nom_forum]</td>
    

          <td>$data[date_commande]</td>";
            if ($data['statut_commande'] == null) {
              echo "<td>
                  non gerer
            </td>
          
         
        ";
            } else {
              echo "<td>
            $data[statut_commande]
      </td>";
            }

            if ($data['nom_admin'] == null) {
              echo "<td>
                  aucun
            </td>
          
         
        ";
            } else {
              echo "<td>
            $data[nom_admin]
      </td>";
            }
            echo "<td>
          $data[total]€
    </td>";
          }

          ?>


        </tbody>
      </table>
    </div>

  </div>


</div>
</section>