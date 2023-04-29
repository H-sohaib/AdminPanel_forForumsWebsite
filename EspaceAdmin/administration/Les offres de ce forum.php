<?php

include("../conf.php");
session_start();
include("gestion_role.php");
require("slide.php");
require("alert_message.php");
require("interdit.php");

$id_forum=$_GET['id_forum'];
?>

<div class="home-content">
  <div class="container" >

 <div class="table-responsive">
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Description</th>
          <th scope="col">Disponible</th>
          <th scope="col">Prix unitaire</th>
         
        </tr>
      </thead>


      <tbody>
        <?php
       

        $query =$cnx->prepare(
        
            "SELECT * FROM offre
            inner join forums_offres on offre.id_offre=forums_offres.id_offre
          
            where forums_offres.id_forum='$id_forum'") ;
        $query->execute();
     

    

        while ($data=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
          <td>$data[id_offre]</td>
          <td>$data[nom]</td>
          <td>$data[description]</td>
          <td>$data[disponible]</td>
          <td>$data[prix_unitaire]€</td>
         
         
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
