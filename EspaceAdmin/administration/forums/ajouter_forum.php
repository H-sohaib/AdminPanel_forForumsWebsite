<?php
// Démarrer une session
session_start();

// Inclure les fichiers nécessaires
include("../../conf.php"); // configuration de la base de données
include("../gestion_role.php"); // gestion des rôles d'utilisateur
require("../interdit.php"); // empêcher l'accès non autorisé à la page
require("../links.php");
require($path_pref."hundle_uploaded_imgs.php")  ;
// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
  // Vérifier si les champs obligatoires sont remplis
  // Récupérer les valeurs du formulaire et les nettoyer
  $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
  $description = htmlspecialchars(strtolower(trim($_POST['description'])));
  $date_creation = date('Y-m-d');
  $visible = @$_POST['visible'] ? 1 : 0;
  $type = htmlspecialchars(strtolower(trim($_POST['type'])));
  $lieu = htmlspecialchars(strtolower(trim($_POST['lieu'])));
  // get the dates &  format it
  if ($_POST['date_debut_forum'])
    $date_debut_forum = DateTime::createFromFormat('d/m/Y', $_POST['date_debut_forum'])->format('Y-m-d');
  if ($_POST['date_fin_forum'])
    $date_fin_forum = DateTime::createFromFormat('d/m/Y', $_POST['date_fin_forum'])->format('Y-m-d');
  if ($_POST['date_fin_inscription'])
    $date_fin_inscription = DateTime::createFromFormat('d/m/Y', $_POST['date_fin_inscription'])->format('Y-m-d');

  // Vérifier si les offres sont sélectionnées
  if (isset($_POST['offres'])) {
    $offres = $_POST['offres'];
  }

  // Vérifier les conditions d'insertion
  if ($date_fin_forum >= $date_debut_forum) {
    // store the logo
    $image_path = hundle_uploaded_imgs();
    // Insérer les données dans la base de données
    $query = $cnx->prepare("INSERT INTO forum (nom,description,lieu,date_debut_forum,date_fin_forum,date_fin_inscription,TYPE,visible,date_creation,unique_id,photo) VALUES('$nom','$description','$lieu','$date_debut_forum','$date_fin_forum','$date_fin_inscription','$type','$visible','$date_creation','$unique_id','$image_path')");

    // Vérifier si l'insertion a réussi
    if ($query->execute()) {
      // Récupérer les données insérées
      $sql = $cnx->prepare("SELECT * from forum where unique_id='$unique_id'");
      $sql->execute();
      $data = $sql->fetch(PDO::FETCH_ASSOC);

      // Insérer les offres associées au forum
      if (isset($offres)) {
        foreach ($offres as $offre) {
          $query2 = $cnx->prepare("INSERT INTO forums_offres (id_forum, id_offre) VALUES('$data[id_forum]', '$offre')");
          $query2->execute();
        }
      }
      // Rediriger l'utilisateur avec un message de succès
      setcookie('message' , "L'ajout du forum est effectué avec success !" , time() + ALERT_EXPIRE_TIME) ;
      header("Location:forums.php");
      exit;
    } else {
      // Rediriger l'utilisateur avec un message d'erreur
      setcookie('error' , "L'ajout du forum à échoué" , time() + ALERT_EXPIRE_TIME) ;
      header("Location:ajouter_forum.php");
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
  <title>Ajouter un forum</title>
</head>

<body id="body-pd" class="bg-gray-100 body-pd">

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
                  <h2 class="leading-relaxed">Créer un forum</h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed">Lorem ipsum, dolor sit amet
                    consectetur
                    adipisicing elit.</p>
                </div>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                  <!-- nom de forum-  -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nom du forum <tr>*</tr> </label>
                    <input name="nom" type="text" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Enter le nom du forum" required>
                  </div>

                  <!-- description de forum -->
                  <div class="flex flex-col">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                      Description</label>
                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your description here..."></textarea>
                  </div>

                  <!-- Lieu   -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Lieu <tr>*</tr> </label>
                    <input type="text" name="lieu" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-600" placeholder="Lieu de forum" required>
                  </div>

                  <!-- Type de forum -->
                  <div class="flex flex-col">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">
                      Choisis le type de forum
                    </label>
                    <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                      <option value="" selected>Choisis un type</option>
                      <option value="Physique">Physique</option>
                      <option value="Virtuelle">Virtuelle</option>
                      <option value="Hybride">Hybride</option>
                    </select>
                  </div>

                  <!-- date de debut et de fin de forum -->
                  <div class="flex items-center space-x-4">
                    <div class="flex flex-col">
                      <label class="block mb-2 text-sm font-medium text-gray-900">Date de debut</label>
                      <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="text" name="date_debut_forum" class="pr-4 pl-10 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-600" placeholder="25/02/2020">
                        <div class="absolute left-3 top-2">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div class="flex flex-col">
                      <label class="block mb-2 text-sm font-medium text-gray-900">Date de fin</label>
                      <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="text" name="date_fin_forum" class="pr-4 pl-10 py-2 border w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-600" placeholder="26/02/2020">
                        <div class="absolute left-3 top-2">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- date de fin d'inscription -->
                  <div class="flex items-center space-x-4">
                    <div class="flex flex-col justify-items-center">
                      <label class="block mb-2 text-sm font-medium text-gray-900">Date de fin d'inscription</label>
                      <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="text" name="date_fin_inscription" class="pr-4 pl-10 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-600" placeholder="26/02/2020">
                        <div class="absolute left-3 top-2">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Visibility -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Choisis
                      la visibilté de forum</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input name="visible" type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                      </div>
                      <span class="ml-3 text-sm font-medium text-gray-900">Visible</span>
                    </label>
                  </div>

                  <!-- upload the image of forum -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file">Choisis
                      un
                      logo pour la forum</label>
                    <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none" aria-describedby="file_input_help" id="file" type="file">
                    <p class="mt-1 text-sm text-gray-500" id="file">SVG, PNG, JPG or
                      GIF (MAX. 800x400px).</p>
                  </div>

                  <!-- les offre pour un forum -->
                  <div class="flex flex-col">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">
                      Offres
                    </label>
                    <div class="flex items-center">
                      <ul class="items-center flex-wrap w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">

                        <?php
                        $sql = $cnx->prepare("SELECT * from offre where visible='1'");
                        $sql->execute();

                        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                          echo "
                            
                            <li class='w-full border-b border-gray-200 sm:border-b-0 sm:border-r '>
                            <div class='flex items-center pl-3'>
                              <input type='checkbox' value='$data[id_offre]' name='offres[]' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2 '>
                              <label for='link-checkbox' class='w-full py-3 ml-2 text-sm font-medium text-gray-900'>" . $data['nom'] . "</label>
                            </div>
                            </li>
                            
                            ";
                        }
                        ?>
                      </ul>
                      <!-- end offres -->
                    </div>
                  </div>
                </div>
                <!-- end form fields input ****************************************************** -->
                <!-- create & cancel buttons -->
                <div class="pt-4 flex items-center space-x-4">
                  <a href="<?= $base_url . 'forums/forums.php' ?> " class=" flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md
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
    </form>
    <!-- form end -->
  </div>
  <!--Container Main end-->




  <script>
    function validateDates() {
      var startDate = new Date(document.getElementById("start").value);
      var endDate = new Date(document.getElementById("end").value);
      var inscription = new Date(document.getElementById("inscription").value);

      if (startDate >= endDate) {
        alert("La date de fin doit être supérieure à la date de début!");
        return false;
      }
      return true;
    }
  </script>

  <?php
  include($path_pref . "side_bar/side_script.php");
  include($path_pref . "js_scripts.php");
  ?>
</body>

</html>