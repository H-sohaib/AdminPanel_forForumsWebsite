<?php
session_start();
include("../../conf.php");
include("../gestion_role.php");
require("../interdit.php");
require("../links.php");

$id_offre = $_GET['id_offre'];
$sql = $cnx->prepare("SELECT * from offre where id_offre='$id_offre'");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);



if (isset($_POST['submit'])) {


  if (empty($nom) || empty($description)) {
    $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
    $description = htmlspecialchars(strtolower(trim($_POST['description'])));
    $prix_unitaire = $_POST['prix_unitaire'];
    $disponible = @$_POST['disponible'] ? 1 : 0;
    $visible = @$_POST['visible'] ? 1 : 0;
    $type = $_POST['type'];

    $query1 = $cnx->prepare("UPDATE offre set nom='$nom',description='$description',prix_unitaire='$prix_unitaire',visible='$visible',id_type_offre='$type', disponible='$disponible' where id_offre='$id_offre'");
    if ($query1->execute()) {
      setcookie('message', "La modification est effectué avec success !", time() + ALERT_EXPIRE_TIME);
      header("Location:offres.php");
      exit;
    } else {
      setcookie('error', "La modification a échoué", time() + ALERT_EXPIRE_TIME);
      header("Location:offres.php");
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
  <title>Modifier offre <?= $data['nom'] ?></title>
</head>

<body id="body-pd" class="bg-gray-100 body-pd">
  <?php include($path_pref . "side_bar/side_bar.php") ?>

  <!--Container Main start-->
  <div class="height-100 bg-light">
    <?php include($path_pref . "alerts.php") ?>
    <!-- form start -->
    <form method="post" enctype="multipart/form-data">
      <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-3">
        <div class="relative">
          <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl ">
            <div class="max-w-xl mx-auto">
              <div class="flex items-center space-x-5">
                <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">
                  i</div>
                <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                  <h2 class="leading-relaxed">Modifier offre : <?= $data['nom'] ?></h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed">Completer le formulaire ci-dessous pour modifier cette offre</p>
                </div>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                  <!-- nom de forum-  -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nom du offre <tr>*</tr> </label>
                    <input value="<?= $data['nom'] ?>" name="nom" type="text" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Enter le nom du forum" required>
                  </div>

                  <!-- description de forum -->
                  <div class="flex flex-col">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                      Description</label>
                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your description here..."> <?= $data['description'] ?></textarea>
                  </div>

                  <!-- prix_unitaire   -->
                  <div class="flex flex-col">
                    <label class=" block mb-2 text-sm font-medium text-gray-900">Prix unitaire <tr>*</tr> </label>
                    <input value="<?= $data['prix_unitaire'] ?>" type="text" name="prix_unitaire" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-600" placeholder="Lieu de forum" required>
                  </div>

                  <!-- Disponibilite -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Choisis
                      la Disponibilté de l'offre</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input <?= $data['disponible'] ?  'checked' : '' ?> name="disponible" type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                      </div>
                      <span class="ml-3 text-sm font-medium text-gray-900">disponible</span>
                    </label>
                  </div>

                  <!-- Visibility -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Choisis
                      la visibilté de forum</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input <?= $data['visible'] ?  'checked' : '' ?> name="visible" type="checkbox" class="sr-only peer">
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
                      <option value=''>Choisis un type</option>
                      <?php
                      $sql = $cnx->prepare("SELECT * FROM type_offre");
                      $sql->execute();
                      while ($type_offre = $sql->fetch(PDO::FETCH_ASSOC)) {
                        if ($type_offre['id_type_offre'] == $data['id_type_offre']) :
                          echo  "<option selected value='$type_offre[id_type_offre]'>$type_offre[nom_type]</option>";
                        else :
                          echo  "<option value='$type_offre[id_type_offre]'>$type_offre[nom_type]</option>";
                        endif;
                      }
                      ?>
                    </select>
                  </div>



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