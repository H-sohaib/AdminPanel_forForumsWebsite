
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Espace recruteur</title>
    
  <link rel="shortcut icon" href="../administration/logo_ftt.png" type="image/x-icon">


          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="../administration/style.css"/>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- Bostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
 
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  </head>
  <body>
 
    <div class="sidebar">
      <div class="logo-details">
      <img  src="../administration/logo_ftt.png" style="width:70px;height:60px"  class="bi bi-code-slash"></img>
        
        <span class="logo_name" style="font-size: 25px;margin-left:10px;">Espace recruteur</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="accueil.php" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Infos general</span>
          </a>
        </li>
        <li>
          <a href="forums.php">
          <i class="bi bi-bag"></i>

            <span class="links_name">Forums</span>
          </a>
        </li>
        <li>
          <a href="mon compte.php">
          <i class="bx bx-user"></i>
            <span class="links_name">Mon compte</span>
          </a>
        </li>
        <li>
          <a  href="#" id="order-link">
            <i class="bx bx-book-alt"></i>
            <span  class="links_name">Commmandes</span>
           
          </a>
          </li>
          <li>
          <div id="order-links">
          <a href="mes commandes.php">
          <i class="fa-sharp fa-solid fa-bolt"></i>
               <span id="order-link" class="links_name">  En cours</span>
          </a>
          <a href="mes commandes passées.php">
          <i class="fa-sharp fa-solid fa-file-circle-check" style="font-size:13px;"></i>  

               <span id="order-link" class="links_name">  Passées</span>
          </a>
</div>
</li>
<li>
          <a href="exposants.php">
          <i class="bx bx-user"></i>
            <span class="links_name">Exposants</span>
          </a>
        </li>
     
        <li class="log_out">
          <a href="deconnexion.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
      <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard"><?php 
          echo ucfirst(str_replace(".php","",basename($_SERVER["PHP_SELF"])));
          ?></span>
        </div>
      
     
       
        

        <div class="profile-details">
          <img src="../administration/photo_admin.png" alt="">
          <span class="admin_name">
            <?php if(isset($_SESSION['nom_responsable'])){echo $_SESSION['nom_responsable'];}?>
          </span>
     
        </div>
    
      </nav>

    
        <script>

let sidebar = document. querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function () {
sidebar.classList.toggle("active");
    if (sidebar.classList.contains ("active")) {
            sidebarBtn.classList.replace("bx-menu","bx-menu-alt-right");
    } else{
            sidebarBtn.classList.replace("bx-menu-alt-right","bx-menu");
    }
};

let orderLink = document.getElementById("order-link");
let orderLinks = document.getElementById("order-links");

orderLink.onclick = function () {
  orderLinks.classList.toggle("visible");
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
    