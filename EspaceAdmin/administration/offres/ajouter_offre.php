<?php
// Démarrer la session
session_start();
// Inclure le fichier de configuration
include("../../conf.php");
// Inclure le fichier de gestion des rôles
include("../gestion_role.php");
// Inclure le fichier d'interdiction d'accès
require("../interdit.php");
require("../links.php");

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
  // Vérifier si les champs nom et description sont non vides
  if (!empty($_POST['nom']) && !empty($_POST['prix_unitaire'] && !empty($_POST['type']))) {
    // Récupérer les données du formulaire en utilisant la méthode post
    $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
    $description = htmlspecialchars(strtolower(trim($_POST['description'])));
    $prix_unitaire = $_POST['prix_unitaire'];
    $disponible = @$_POST['disponible'] ? 1 : 0;
    $visible = @$_POST['visible'] ? 1 : 0;
    $type = $_POST['type'];

    // Préparer la requête d'insertion dans la base de données
    if ($type)
      $query = $cnx->prepare("INSERT INTO offre (nom, description, disponible,prix_unitaire,visible,id_type_offre) VALUES('$nom', '$description', '$disponible','$prix_unitaire','$visible','$type')");
    else
      $query = $cnx->prepare("INSERT INTO offre (nom, description, disponible,prix_unitaire,visible) VALUES('$nom', '$description', '$disponible','$prix_unitaire','$visible')");
    // Exécuter la requête d'insertion dans la base de données
    if ($query->execute()) {
      // Si l'insertion a réussi, rediriger l'utilisateur vers la page des offres avec un message de confirmation
      setcookie('message', "L'ajout de l'offre est effectué avec success !", time() + ALERT_EXPIRE_TIME);
      header("Location:offres.php");
      exit;
    } else {
      // Si l'insertion a échoué, afficher un message d'erreur
      setcookie('error', "L'ajout de l'offre a échoué", time() + ALERT_EXPIRE_TIME);
      header("Location:ajouter_offre.php");
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
  <title>Ajouter une offre</title>
</head>

<body>
  <?php include($path_pref . "side_bar/side_bar.php") ?>
  <!-- Container Main start -->
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
                  <h2 class="leading-relaxed">Créer une offre </h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed"></p>
                </div>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                  <!-- nom de offre-  -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nom de l'offre <tr>*</tr> </label>
                    <input name="nom" type="text" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Entrer le nom de l'offre" required>
                  </div>

                  <!-- description de offre -->
                  <div class="flex flex-col">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                      Description</label>
                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your description here..."></textarea>
                  </div>

                  <!-- Prix unitaire   -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Prix unitaire <tr>*</tr> </label>
                    <input type="number" name="prix_unitaire" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-600" placeholder="Prix unitaire de l'offre" required>
                  </div>

                  <!-- disponible -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">
                      Choisis
                      la Disponibilté de l'offre</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input name="disponible" type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                      </div>
                      <span class="ml-3 text-sm font-medium text-gray-900">Disponible</span>
                    </label>
                  </div>
                  <!-- Visibility -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Choisis
                      la visibilté de forum</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input name="visible" type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                      </div>
                      <span class="ml-3 text-sm font-medium text-gray-900">Visible</span>
                    </label>
                  </div>

                  <!-- categorie pour un offre -->
                  <div class="flex flex-col">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Choisis la catégorie <tr>*</tr> 
                    </label>

                    <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                      <option value="" selected>--Choisis un type</option>
                      <?php
                      $sql = $cnx->prepare("SELECT * from type_offre");
                      $sql->execute();
                      while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                          <option value='$data[id_type_offre]'> $data[nom_type] </option>
                          ";
                      }
                      ?>
                      <!-- end categorie  -->
                    </select>
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