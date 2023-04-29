<?php
session_start();
include("../../conf.php");
include("../gestion_role.php");
require("../interdit.php");
require("../links.php");

if (isset($_POST['submit'])) {
  if (!empty($_POST['nom'])) {
    $nom_type = htmlspecialchars(strtolower(trim($_POST['nom'])));
    $query1 = $cnx->prepare("INSERT into type_offre (nom_type) values('$nom_type')");
    if ($query1->execute()) {
      setcookie('message', "La modification est effectué avec success !", time() + ALERT_EXPIRE_TIME);
      header("Location:catégorie.php");
      exit;
    } else {
      setcookie('error', "L'ajoutement a échoué", time() + ALERT_EXPIRE_TIME);
      header("Location:ajouter_catégorie.php");
      exit;
    }
  }
}
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
  <title>Ajouter une catégorie</title>
</head>

<body>

  <?php include($path_pref . "side_bar/side_bar.php") ?>

  <!--Container Main start-->
  <div class="height-100 bg-light">
    <?php include($path_pref . "alerts.php") ?>

    <form method="post" enctype="multipart/form-data">
      <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-3">
        <div class="relative">
          <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl ">
            <div class="max-w-xl mx-auto">
              <div class="flex items-center space-x-5">
                <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">
                  i</div>
                <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                  <h2 class="leading-relaxed">Créer une catégorie</h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed">Completer le formulaire ci-dessous pour Ajouter une catégorie</p>
                </div>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                  <!-- nom de offre-  -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nom de la catégorie <tr>*</tr> </label>
                    <input name="nom" type="text" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Entrer le nom de la catégorie" required>
                  </div>


                  <!-- end form fields input ****************************************************** -->
                  <!-- create & cancel buttons -->
                  <div class="pt-4 flex items-center space-x-4">
                    <a href="<?= $base_url . 'offres/offres.php' ?> " class=" flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md
                  focus:outline-none">
                      <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                      </svg> Annuler
                    </a>
                    <button name="submit" type="submit" class=" bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md
                  focus:outline-none">Créer</button>
                  </div>
                  <!-- end create & cancel button -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- form end -->
  </div>


  <?php
  include($path_pref . "side_bar/side_script.php");
  include($path_pref . "js_scripts.php");
  ?>

</body>

</html>