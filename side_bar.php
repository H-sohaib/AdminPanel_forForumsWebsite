  <div class="sidebar">
    <div class="logo-details">
      <img src="<?= $ASSETS_PATH . 'imgs/logo_ftt.png' ?>" style="width:70px;height:60px"
        class="bi bi-code-slash"></img>
      <span class="logo_name" style="font-size: 22px;">Espace Admin</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="<?= $base_url . 'tableau_bord.php' ?>" class="active">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Tableau de bord</span>
        </a>
      </li>
      <li>
        <a href="<?= $base_url . 'entreprises.php' ?>">
          <i class="bx bx-user"></i>
          <span class="links_name">Entreprises</span>
        </a>
      </li>
      <li>
        <a href="<?= $base_url . 'forums/forums.php' ?>">
          <i class="bi bi-bag"></i>
          <span class="links_name">Forums</span>
        </a>
      </li>
      <li>
        <a href="<?= $base_url . 'offres/offres.php' ?>">
          <i class="fa-sharp fa-solid fa-store"></i>
          <span class="links_name">Offres</span>
        </a>
      </li>
      <li>
        <a href="<?= $base_url . 'categorie_offre/catégorie.php' ?>">
          <i class="bx bx-list-ul"></i>
          <span class="links_name">catégorie</span>
        </a>
      </li>
      <li>
        <a href="#" id="order-link">
          <i class="bx bx-book-alt"></i>
          <span class="links_name" onclick="togle()">Commmandes</span>
        </a>
      </li>
      <li>
        <div id="order-links">
          <a class="ps-3" href="<?= $base_url . 'commandes.php' ?>"">
            <i class=" fa-sharp fa-solid fa-receipt" style="font-size:15px;"></i>
            <span id="order-link" class="links_name"> En cours</span>
          </a>
          <a class="ps-3" href="commandes passées.php">
            <i class="fa-sharp fa-solid fa-file-circle-check" style="font-size:13px;"></i>
            <span id="order-link" class="links_name"> Passées</span>
          </a>
        </div>
      </li>


      <li>
        <a href="archive des commandes.php">
          <i class="bx bx-box"></i>
          <span class="links_name">Archives commandes</span>
        </a>

      </li>
      <li>
        <a href="<?= $base_url . 'admins/admin.php' ?>">
          <i class="bx bx-cog"></i>
          <span class="links_name">Admin</span>
        </a>
      </li>

      <li class="log_out">
        <a href="<?= $base_url . 'deconnexion.php' ?>">
          <i class="bx bx-log-out"></i>
          <span class="links_name">Déconnexion</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <!-- burger icon -->
      <div class="sidebar-button">
        <i class="bx bx-menu sidebarBtn"></i>
        <span class="dashboard">
          <?php
          echo ucfirst(str_replace(".php", "", basename($_SERVER["PHP_SELF"])));
          ?>
        </span>
      </div>

      <!-- searsh bar -->
      <form>
        <div class="search-box">
          <input type="text" id="myInput" onkeyup="Search()" placeholder="Recherche... " style="width:33vw;" />
          <button type="submit" style="border:0 ;right:45px;  " class="bx bx-search"></button>
        </div>
      </form>

      <!-- profils icone -->
      <div class="profile-details">
        <img src="<?= $ASSETS_PATH ?>imgs/photo_admin.png" alt="">
        <span class="admin_name">
          <?php echo $_SESSION['nom_admin'] ?>
        </span>
      </div>

    </nav>
  </section>