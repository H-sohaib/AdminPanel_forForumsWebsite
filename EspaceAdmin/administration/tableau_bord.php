<?php
include("../conf.php");
session_start();
// include("gestion_role.php");
require("interdit.php");
require("links.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  // include commun css link
  require($path_pref . "head_links.php");
  // include depencease of side bar 
  require($path_pref . "side_bar/side_link.php");
  ?>
  <title>Forums</title>
</head>

<body id="body-pd" class="bg-gray-100">
  <?php include($path_pref . "side_bar/side_bar.php") ?> 
  <!--Container Main start-->
  <section class="height-100 bg-light">
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Entreprises</div>
            <div class="text ">
              <div class="number">

                <div class="number">
                  <?php
                  $query1 = $cnx->prepare("SELECT count(*) as total from entreprise");
                  $query1->execute();
                  $data = $query1->fetch(PDO::FETCH_ASSOC);
                  echo $data['total'];

                  ?>
                </div>
              </div>
            </div>
            <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>

            </div>
          </div>
          <i class="bx bx-cart-alt cart" style="font-size:48px"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Forums</div>
            <div class="text ">
              <div class="number">

                <div class="number">
                  <?php

                  $query2 = $cnx->prepare("SELECT count(*) as total from forum");
                  $query2->execute();
                  $data = $query2->fetch(PDO::FETCH_ASSOC);
                  echo $data['total'];
                  ?>
                </div>
              </div>
            </div>
            <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>

            </div>
          </div>
          <i class="bx bx-cart-alt cart" style="font-size:48px"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Offres</div>
            <div class="text ">
              <div class="number">
                <div class="number">
                  <?php
                  $query3 = $cnx->prepare("SELECT count(*) as total from offre");
                  $query3->execute();
                  $data = $query3->fetch(PDO::FETCH_ASSOC);
                  echo $data['total'];
                  ?>
                </div>
              </div>
            </div>
            <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>

            </div>
          </div>
          <i class="bx bx-cart-alt cart" style="font-size:48px"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Commandes</div>
            <div class="text ">

              <div class="number">
                <?php
                $query4 = $cnx->prepare("SELECT * from commande ");
                $query4->execute();
                $total = $query4->rowCount();
                echo $total;
                ?>
              </div>
            </div>


            <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>

            </div>
          </div>
          <i class="bx bxs-box cart two"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Commande acceptées</div>
            <div class="text ">
              <div class="number">
                <?php

                $query5 = $cnx->prepare("SELECT * from commande where statut='valider'");
                $query5->execute();
                $total = $query5->rowCount();
                echo $total;
                ?>

              </div>
            </div>


            <div class="indicator">
              <i class="bx bx-down-arrow-alt down"></i>

            </div>
          </div>
          <i class='bx bxs-user cart un'></i>
          <!--<i class="bx bx-cart cart three"></i>-->
        </div>

        <div class="box">
          <div class="right-side">
            <div class="box-topic">Commandes refusées</div>
            <div class="text ">
              <div class="number">
                <div class="number">
                  <?php


                  $query6 = $cnx->prepare("SELECT * from commande where statut='refuser'");
                  $query6->execute();
                  $total = $query6->rowCount();
                  echo $total;
                  ?>
                </div>
              </div>

            </div>
            <div class="indicator">
              <i class="bx bx-up-arrow-alt"></i>

            </div>
          </div>
          <i class="bx bx-cart cart four" style="font-size:48px"></i>
        </div>
      </div>
    </div>
  </section>

  <?php
  include($path_pref . "side_bar/side_script.php");
  include($path_pref . "js_scripts.php");
  ?>
</body>

</html>