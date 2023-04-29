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
  <h3>Information sur l'entreprise</h3>
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
          <th scopre="col">Logo</th>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Secteur</th>
          <th scope="col">Ville</th>
          <th scope="col">Code postal</th>
          <th scope="col">Adresse</th>
          <th scope="col">Telephone</th>
          <th scope="col">Action</th>
     
        </tr>
      </thead>


      <tbody>
        <?php
       $id_entreprise=$_GET['id_entreprise'];

        $query =$cnx->prepare("SELECT * FROM entreprise where id_entreprise='$id_entreprise'") ;
        $query->execute();
     

    

        if ($data=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
          <td>";
          if($data['logo']==null){
            echo '<img src="../uploads/'.$data['logo'].'" style="width:50px; height:50px"/>';
          }else{
            echo '<img src="../uploads/default.png" style="width:40px; height:40px"/>';
          }
          echo "
          </td>
          <td>$data[id_entreprise]</td>
          <td>$data[nom]</td>
          <td>$data[secteur]</td>
          <td>$data[ville]</td>
          <td>$data[code_postal]</td>
          <td>$data[adresse]</td>
          <td>$data[telephone]</td>
          <td>
          <a class='link-info' href='modif_entreprise.php?id_entreprise=$data[id_entreprise]'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
          <a class='link-dark' style='border:0;' class='fa-solid fa-trash fs-5 me-3' href='supp_entreprise.php?id_entreprise=$data[id_entreprise]'><span class='fa-solid fa-trash fs-5 me-3'></span></a>           
          <a class='link-dark' style='border:0;' class='fa-solid fa-trash fs-5 me-3' href='ajouter_facture.php?id_entreprise=$data[id_entreprise]'><span class='fa-sharp fa-solid fa-file-invoice-dollar'></span></a>           
          
        </td>   
        </tr>
          ";

        }
        ?>

       
      </tbody>
    </table>
 </div>
 <div class="table-responsive">
  <?php
$id_entreprise=$_GET['id_entreprise'];
$s=$cnx->prepare("SELECT * from entreprise where id_entreprise='$id_entreprise' and id_responsable is null");
$s->execute();
if($s->rowCount()==1){
  echo ' <a href="ajouter_responsable.php?id_entreprise=<?php echo $id_entreprise; ?>" class="btn btn-outline-info mb-3" style="border: 1px solid #00bfff;">Ajouter un responsable</a> ';
}
  ?>

  <h3>Responsable de l'entreprise</h3>
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
       
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Fonction</th>
          <th scope="col"> Email</th>
          <th scope="col">Telephone</th>
        </tr>
      </thead>


      <tbody>
        <?php
             $info =$cnx->prepare("SELECT * FROM entreprise where id_entreprise='$id_entreprise'") ;
             if($info->execute()){
if($res=$info->fetch(PDO::FETCH_ASSOC)){
  $id_responsable=$res['id_responsable'];
}
             }
   

        $query =$cnx->prepare("SELECT * FROM responsable where id_responsable='$id_responsable'") ;
        $query->execute();
     

    

        if ($data_responsable=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
          <td>$data_responsable[id_responsable]</td>
          <td>$data_responsable[nom]</td>
          <td>$data_responsable[prenom]</td>
          <td>$data_responsable[fonction]</td>
          <td>$data_responsable[email]</td>
   
          <td>$data_responsable[telephone]</td>
       
  
        </tr>
          ";

        }
        ?>

       
      </tbody>
    </table>
 </div>
 <div class="table-responsive">
 <a href="ajouter_exposant.php?id_entreprise=<?php echo $id_entreprise; ?>" class="btn btn-outline-info mb-3" style="border: 1px solid #00bfff;">Nouveau exposant</a>

  <h3>Exposants de l'entreprise</h3>
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
        
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Fonction</th>
          <th scope="col">email</th>
          <th scope="col">telephone</th>
          <th scope="col">Telecharger</th>
         
        </tr>
      </thead>

      <tbody>
        <?php
      

        $query =$cnx->prepare("SELECT * FROM exposants where id_entreprise='$id_entreprise'") ;
        $query->execute();
     

    

        while ($data_exposant=$query->fetch(PDO::FETCH_ASSOC)) {
        
          echo "

          <tr>
          
          <td>$data_exposant[id_exposant]</td>
          <td>$data_exposant[nom]</td>
          <td>$data_exposant[prenom]</td>
          <td>$data_exposant[fonction]</td>
          <td>$data_exposant[email]</td>
      
          <td>$data_exposant[telephone]</td>
        <td>  <a class='link-info' href='../administration/telecharger.php?file=$data_exposant[badge]'><i class='fa-solid fa-download'></i></a></td>

        
        
        </tr>
          ";

        }
        ?>

       
      </tbody>
    </table>
 </div>
 <div class="table-responsive">
  <h3>Factures de l'entreprise</h3>
 <table class="table table-striped table-hover text-center " id="myTable" >
      <thead class="table-dark ">
        <tr>
       
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Description</th>
          <th scope="col">Taille</th>
          <th scope="col">id_commande</th>
          <th scope="col">Forum</th>
     
          <th scope="col">Télécharger</th>
        </tr>
      </thead>


      <tbody>
        <?php
       $id_entreprise=$_GET['id_entreprise'];

        $query =$cnx->prepare("SELECT commande.nom_forum,facture.id_facture,facture.nom_facture,facture.description,facture.size,facture.id_commande FROM facture
        inner join commande on facture.id_commande=commande.id_commande
        where facture.id_entreprise='$id_entreprise'") ;
        $query->execute();
     

    

        while ($data_facture=$query->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
        
          <td>$data_facture[id_facture]</td>
          <td>$data_facture[nom_facture]</td>
          <td>$data_facture[description]</td>
          <td>$data_facture[size]</td>
          <td>$data_facture[id_commande]</td>
          <td>$data_facture[nom_forum]</td>
         
          <td>
          
          <a class='link-info' href='../administration/telecharger.php?file=$data_facture[nom_facture]'><i class='fa-solid fa-download'></i></a>
            
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





