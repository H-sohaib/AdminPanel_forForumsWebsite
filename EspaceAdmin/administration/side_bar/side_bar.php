<header class="header body-pd" id="header">
  <div class="header_toggle">
    <i class="bx bx-menu" id="header-toggle"></i>
    <!-- name of page -->
    <span class="page-title">
      <?php
      echo ucfirst(str_replace(".php", "", basename($_SERVER["PHP_SELF"])));
      ?>
    </span>
  </div>

  <div class="flex align-middle justify-end w-50">
    <!-- searsh bar   -->
    <div class="search me-6 w-75 justify-items-start">
      <i class="fa fa-search"></i>
      <input type="text" class="form-control" placeholder="Have a question? Ask Now">
      <button class="btn btn-primary">Search</button>
    </div>


    <div class="user-info">
      <p><?= $_SESSION['nom_admin'] . ' ' . $_SESSION['prenom_admin'] ?></p>
      <img src="<?= $ASSETS_PATH . 'imgs/photo_admin.png' ?>" alt="" />
    </div>
  </div>
</header>
<div class="l-navbar show" id="nav-bar">
  <nav class="nav">
    <div>
      <a href="#" class="nav_logo">
        <i class="bx bx-layer nav_logo-icon"></i>
        <span class="nav_logo-name">Espace Admin</span>
      </a>
      <div class="nav_list">
        <a href="<?= $base_url . 'tableau_bord.php' ?>" class="nav_link <?= stripos($_SERVER['PHP_SELF'],"tableau_bord.php" ) ? 'active' :'' ?>">
          <i class="bx bx-grid-alt nav_icon"></i>
          <span class="nav_name">Tableau de bord</span>
        </a>
        <a href="<?= $base_url . 'forums/forums.php' ?>" class="nav_link <?= stripos($_SERVER['PHP_SELF'],"forums" ) ? 'active' :'' ?>">
          <i class="bx bx-user nav_icon"></i>
          <span class="nav_name">Forums</span>
        </a>
        <a href="<?= $base_url . 'offres/offres.php' ?>" class="nav_link <?= stripos($_SERVER['PHP_SELF'],"offres" ) ? 'active' :'' ?>">
          <i class="bx bx-bookmark nav_icon"></i>
          <span class="nav_name">Offres</span>
        </a>
        <a href="<?= $base_url . 'categorie_offre/catégorie.php' ?>" class="nav_link <?= stripos($_SERVER['PHP_SELF'],"categorie_offre" ) ? 'active' :'' ?>">
          <i class="bx bx-message-square-detail nav_icon"></i>
          <span class="nav_name">Catégorie</span>
        </a>
        <a href="<?= $base_url . 'admins/admin.php' ?>" class="nav_link <?= stripos($_SERVER['PHP_SELF'],"admins" ) ? 'active' :'' ?>">
          <i class="bx bx-folder nav_icon"></i>
          <span class="nav_name">Admin</span>
        </a>
      </div>
    </div>
    <a href="<?= $base_url . 'deconnexion.php' ?>" class="nav_link">
      <i class="bx bx-log-out nav_icon"></i>
      <span class="nav_name">Déconnexion</span>
    </a>
  </nav>
</div>