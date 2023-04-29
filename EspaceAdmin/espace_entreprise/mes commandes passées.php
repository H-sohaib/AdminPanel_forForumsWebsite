<?php

include("../conf.php");
session_start();

include("alert_message.php");
require("side.php");
$id_entreprise=$_SESSION['id_entreprise'];


?>

<div class="home-content">
  <div class="container" >

 <div class="table-responsive">
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
          
          <th scope="col">Forum</th>
          <th scope="col">Statut</th>
          <th scope="col">Date de la commande</th>
          <th scope="col">bon de commande signée</th>
          <th scope="col">Facture</th>


         

        </tr>
      </thead>


      <tbody>
        <?php
       

        $query =$cnx->prepare("SELECT commande.id_commande, commande.nom_forum, commande.date_commande, commande.statut, commande.bon_de_commande_signee, commande.bon_de_commande, facture.nom_facture 
        FROM commande
        LEFT JOIN facture ON facture.id_commande = commande.id_commande
        WHERE commande.id_entreprise = '$id_entreprise' AND statut IS NOT NULL ") ;
        $query->execute();

        while ($data=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>

          <td>$data[nom_forum]</td>";
        
         echo "<td> $data[statut]</td> ";

         echo "<td>$data[date_commande]</td>";
        
         echo "<td>
         <a class='link-info' href='../administration/telecharger.php?file=$data[bon_de_commande_signee]'><i class='fa-solid fa-download'></i></a>
         </td>
         <td>
         <a class='link-info' href='../administration/telecharger.php?file=$data[nom_facture]'><i class='fa-solid fa-download'></i></a>
         </td>
         ";

  

        }
   
        ?>

       
      </tbody>
    </table>
 </div>
 
  </div>


</div>
    </section>
