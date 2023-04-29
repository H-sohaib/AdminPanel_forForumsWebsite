<?php

include("../conf.php");
session_start();
include("gestion_role.php");
include("slide.php");
include("alert_message.php");
include("interdit.php");



?>

<div class="home-content">
  <div class="container">
    <a href="ajouter_entreprise.php" class="btn btn-outline-info mb-3" style=" border: 1px solid 	#00bfff  ;">Nouvelle
      entreprise</a>

    <div class="table-responsive">
      <table class="table table-striped table-hover text-center " id="myTable">
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


          $query = $cnx->prepare("SELECT * FROM entreprise");
          $query->execute();




          while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "
          <tr>
          <td>";
            if ($data['logo'] == null) {
              echo '<img src="../uploads/' . $data['logo'] . '" style="width:50px; height:50px"/>';
            } else {
              echo '<img src="../uploads/default.png" style="width:40px; height:40px"/>';
            }
            echo "
          </td>
          <td>$data[id_entreprise]</td>
          <td><a href='entreprise.php?id_entreprise=$data[id_entreprise]'>$data[nom]</td>
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

  </div>


</div>
</section>