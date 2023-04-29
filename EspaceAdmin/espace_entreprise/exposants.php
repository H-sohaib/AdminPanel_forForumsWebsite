<?php

include("../conf.php");
session_start();
include("alert_message.php");

include("side.php");

?>

<div class="home-content">
  <div class="container" >
    <a href="ajouter exposant.php" class="btn btn-outline-info mb-3" style=" border: 1px solid 	#00bfff  ;" >Nouveau  exposant</a>

 <div class="table-responsive">
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
        <th scopre="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Fonction</th>
          <th scope="col">Email</th>
          <th scope="col">Telephone</th>
          <th scope="col">Forum</th>

          <th scope="col">Telecharger le badge</th>
        </tr>
      </thead>


      <tbody>
        <?php
    
        $query =$cnx->prepare("SELECT exposants.nom,exposants.prenom,exposants.fonction,exposants.email,exposants.telephone,exposants.badge,commande.nom_forum FROM exposants 
        inner join commande on commande.id_commande=exposants.id_commande") ;
        $query->execute();
     
        while ($data=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
          
          <td>$data[nom]</td>
          <td>$data[prenom]</td>
          <td>$data[fonction]</td>
          <td>$data[email]</td>
          <td>$data[telephone]</td>
          <td>$data[nom_forum]</td>
       
          <td>
          <a class='link-info' href='../administration/telecharger.php?file=$data[badge]'><i class='fa-solid fa-download'></i></a>
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
