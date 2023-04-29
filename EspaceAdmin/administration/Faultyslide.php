<?php
require("links.php");
// echo $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Administration</title>
  <?php if (contains($_SERVER['REQUEST_URI'], $paths)) :
    $path_pref = '../';
  ?>
    <link rel="stylesheet" href="../style.css" />
    <link rel="shortcut icon" href="../logo_ftt.png" type="image/x-icon">
  <?php else :
    $path_pref = '';
  ?>
    <link rel="shortcut icon" href="logo_ftt.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
  <?php endif ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Boxicons CDN Link -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <!-- Bostrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>

<body>
  <!-- <div class="container"> -->
  <div class="col-4">
    <div class="sidebar col-8">
      <div class="logo-details">
        <img src="<?= $path_pref ?>logo_ftt.png" style="width:70px;height:60px" class="bi bi-code-slash"></img>
        <span class="logo_name" style="font-size: 22px;">Espace Admin</span>
      </div>
      <ul class="nav-links">
        <li>
          <!-- <a href="tableau de bord.php" class="active"> -->
          <a href="<?= $base_url . 'tableau_bord.php' ?>" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Tableau de bord</span>
          </a>
        </li>
        <li>
          <!-- <a href="entreprises.php"> -->
          <a href="<?= $base_url . 'entreprises.php' ?>">
            <i class="bx bx-user"></i>
            <span class="links_name">Entreprises</span>
          </a>
        </li>
        <li>
          <!-- <a href="forums/forums.php"> -->
          <a href="<?= $base_url . 'forums/forums.php' ?>">
            <i class="bi bi-bag"></i>
            <span class="links_name">Forums</span>
          </a>
        </li>
        <li>
          <!-- <a href="offres/offres.php"> -->
          <a href="<?= $base_url . 'offres/offres.php' ?>">
            <i class="fa-sharp fa-solid fa-store"></i>
            <span class="links_name">Offres</span>
          </a>
        </li>
        <li>
          <!-- <a href="categorie_offre/catégorie.php"> -->
          <a href="<?= $base_url . 'categorie_offre/catégorie.php' ?>">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Catégorie</span>
          </a>
        </li>
        <li>
          <a href="#" id="order-link">
            <i class="bx bx-book-alt"></i>
            <span class="links_name" onclick="togle()">Commmandes</span>

          </a>
        </li>
        <li>
          <!-- <div id="order-links"> -->
          <!-- <a href="commandes.php"> -->
          <a href="<?= $base_url . 'commandes.php' ?>">
            <i class="fa-sharp fa-solid fa-receipt" style="font-size:15px;"></i>
            <span id="order-link" class="links_name"> En cours</span>
          </a>
        </li>
        <li>
          <a href="commandes passées.php">
            <i class="fa-sharp fa-solid fa-file-circle-check" style="font-size:13px;"></i>
            <span id="order-link" class="links_name"> Passées</span>
          </a>
          <!-- </div> -->
        </li>
        <li>
          <a href="archive des commandes.php">
            <i class="bx bx-box"></i>
            <span class="links_name">Archives commandes</span>
          </a>
        </li>
        <li>
          <!-- <a href="admins/admin.php"> -->
          <a href="<?= $base_url . 'admins/admin.php' ?>">
            <i class="bx bx-cog"></i>
            <span class="links_name">Admin</span>
          </a>
        </li>
        <li class="log_out">
          <a href="<?= $base_url . 'deconnexion.php' ?>">
            <a href="deconnexion.php">
              <i class="bx bx-log-out"></i>
              <span class="links_name">Déconnexion</span>
            </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- <section class="home-section"> -->
  <div class="row">
    <nav class="nav-bar">
      <div class="sidebar-button">
        <i class="bx bx-menu sidebarBtn"></i>
        <span class="dashboard">
          <?php
          echo ucfirst(str_replace(".php", "", basename($_SERVER["PHP_SELF"])));
          ?>
        </span>
      </div>
      <form>
        <div class="search-box">
          <input type="text" id="myInput" onkeyup="Search()" placeholder="Recherche... " style="width:33vw;" />
          <button type="submit" style="border:0 ;right:45px;  " class="bx bx-search"></button>
        </div>
      </form>
      <div class="profile-details">
        <img src="<?= $path_pref ?>photo_admin.png" alt="">
        <span class="admin_name">
          <?php echo $_SESSION['nom_admin'] ?>
        </span>
      </div>
    </nav>
  </div>
  <!-- </section> -->
  <!-- </div> -->

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    };

    let orderLink = document.getElementById("order-link");
    let orderLinks = document.getElementById("order-links");

    function togle() {
      orderLinks.classList.toggle("visible");
      console.log("o")
    }

    function Search() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>