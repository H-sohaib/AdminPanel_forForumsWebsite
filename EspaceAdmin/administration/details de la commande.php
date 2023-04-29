<?php

include("../conf.php");
session_start();
include("gestion_role.php");
require("slide.php");
require("alert_message.php");
require("interdit.php");

?>

<div class="home-content">
  <div class="container" >

 <div class="table-responsive">
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
          <th scope="col">ID offre</th>
          <th scope="col">Nom</th>
          <th scope="col">Description</th>
          <th scope="col">Prix unitaire</th>

        
        </tr>
      </thead>


      <tbody>
        <?php
       
 $id_commande=$_GET['id_commande'];
        $query =$cnx->prepare("SELECT * FROM offre
        inner join detail_commande on detail_commande.id_offre=offre.id_offre
  
        where detail_commande.id_commande='$id_commande'
         ") ;
        $query->execute();

      
     

    

        while ($data=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
          <td>$data[id_offre]</td>
          <td>$data[nom]</td>
          <td>$data[description]</td>
          <td>$data[prix_unitaire]</td>
       
        
         
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
