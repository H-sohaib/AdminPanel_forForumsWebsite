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
          <th scope="col">Total</th>
          <th scope="col">Bon de commande à signer</th>
          <th scope="col">Envoyer bon de commande</th>


        </tr>
      </thead>


      <tbody>
        <?php
       

        $query =$cnx->prepare("SELECT commande.total,commande.id_commande,commande.nom_forum,commande.date_commande,commande.statut,commande.bon_de_commande  FROM commande
    
        where id_entreprise='$id_entreprise' && statut is null
     
         ") ;
        $query->execute();

      

        //read data of each row
        while ($data=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>

          <td>$data[nom_forum]</td>";
          if($data['statut']==null){
            echo "<td>
                  en attente
            </td>
          
         
        ";
          }else{
            echo "<td>
            $data[statut]
      </td>
  ";

          }
          
         
         echo "<td>$data[date_commande]</td>";
         echo "<td>$data[total]€</td>";
         if(isset($data['bon_de_commande'])){
         echo "    <td>
         <a class='link-info' href='../administration/telecharger.php?file=$data[bon_de_commande]'><i class='fa-solid fa-download'></i></a>
         </td>";

         }
       echo   "
         <td title='bon de commande signé'>
         <a class='link-dark' style='border:0; margin-right:15px' class='fa-sharp fa-regular fa-plus' href='ajouter bon de commande.php?id_commande=$data[id_commande]'><span class='fa-sharp fa-regular fa-plus'</span></a>   
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
