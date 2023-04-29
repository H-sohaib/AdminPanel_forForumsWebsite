<?php
include("../../conf.php");
session_start();
require("../slide.php");
require("../alert_message.php");
include("../gestion_role.php");
require("../interdit.php");
?>

<section>
  <div class="home-content">
    <div class="container">
      <a href="ajouter_forum.php" class="btn btn-outline-info mb-3" style=" border: 1px solid 	#00bfff  ;">+ Nouveau
        forum</a>
      <div class="table-responsive">
        <table class="table table-striped table-hover text-center " id="myTable">
          <thead class="table-dark ">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nom</th>
              <th scope="col">Description</th>
              <th scope="col">Date du forum</th>
              <th scope="col">Lieu</th>
              <th scope="col">Type</th>
              <th scope="col">Date debut </th>
              <th scope="col">Date fin </th>
              <th scope="col">Fin inscription </th>
              <th scope="col">Visible </th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $cnx->prepare("SELECT * FROM forum");
            $query->execute();
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

              echo "
          <tr>
          <td>$data[id_forum]</td>    
          <td><a href='Les offres de ce forum.php?id_forum=$data[id_forum]'>$data[nom]</td>
          <td style='text-align:justify;'>$data[description]</td>
          <td>$data[date_creation]</td>
          <td>$data[lieu]</td>
          <td>$data[TYPE]</td>
          <td>$data[date_debut_forum]</td>
          <td>$data[date_fin_forum]</td>
          <td>$data[date_fin_inscription]</td>";
              echo "<td>";
              if ($data['visible'] == 0) {
                echo "non";
              } else {
                echo "oui";
              }

              echo "<td>
            <a class='link-info' href='modif_forum.php?id_forum=$data[id_forum]'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
            <a class='link-dark' style='border:0;' class='fa-solid fa-trash fs-5 me-3' href='supp_forum.php?id_forum=$data[id_forum]'><span class='fa-solid fa-trash fs-5 me-3'></span></a>           
          
            
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