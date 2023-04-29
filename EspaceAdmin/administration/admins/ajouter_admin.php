<?php
require("../../conf.php");
session_start();
include("../gestion_role.php");
require("../interdit.php");
require("../links.php");

function validate_password($password, $confirm_password)
{
  if( strlen($password) < 8) {
    setcookie('error', "Le mode de passe que vous entrez est tres petite.", time() + ALERT_EXPIRE_TIME);
    header("Location:ajouter_admin.php");
    exit;
  }
  
  if ($password !== $confirm_password) {
    setcookie('error', "error à la confirmation de mode passe , verifier le mode passe .", time() + ALERT_EXPIRE_TIME);
    header("Location:ajouter_admin.php");
    exit;
  }
}

// Si le formulaire est soumis
if (isset($_POST['submit'])) {
  // Vérifier si le champ nom est rempli
  if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Récupérer les données du formulaire et les nettoyer pour éviter les attaques XSS
    $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
    $prenom = htmlspecialchars(strtolower(trim($_POST['prenom'])));
    $email = htmlspecialchars(strtolower(trim($_POST['email'])));
    // Hacher le mot de passe pour le stocker en toute sécurité
    validate_password($_POST['password']  , $_POST['confirm_password']) ;
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // Récupérer le rôle de l'admin à partir du formulaire
    $role = $_POST['role'];
    // Insérer les données dans la base de données
    $query = $cnx->prepare("INSERT INTO admin (nom, prenom, email,PASSWORD,id_role) VALUES('$nom', '$prenom', '$email','$password','$role')");
    if ($query->execute()) {
      // Si l'insertion est réussie, afficher un message de succès et rediriger vers la page d'administration
      setcookie('message', "L'ajout de l'admin est effectué avec success !", time() + ALERT_EXPIRE_TIME);
      header("Location:admin.php");
      exit;
    } else {
      setcookie('error', "L'ajout de l'admin à échoué", time() + ALERT_EXPIRE_TIME);
      header("Location:ajouter_admin.php");
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
  <title>Ajouter un admin</title>
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
                  <h2 class="leading-relaxed">Créer un admin </h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed"></p>
                </div>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">

                  <!-- nom   -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Le nom<tr>*</tr> </label>
                    <input name="nom" type="text" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Entrer le nom d'admin" required>
                  </div>

                  <!-- prenom   -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Le prénom<tr>*</tr> </label>
                    <input name="prenom" type="text" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Entrer le nom d'admin" required>
                  </div>

                  <!-- Email   -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Email<tr>*</tr> </label>
                    <input name="email" type="email" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Entrer l'email d'admin" required>
                  </div>

                  <!-- password-  -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Mode de passe<tr>*</tr> </label>
                    <input name="password" type="password" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="Entrer le mode de passe" required>
                  </div>

                  <!-- Confirm password-  -->
                  <div class="flex flex-col">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Confirmation de mode de passe<tr>*</tr> </label>
                    <input name="confirm_password" type="password" class="px-4 py-2 border  w-full sm:text-sm border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500  text-gray-600" placeholder="confirmer le mode de passe" required>
                  </div>

                  <!-- role d'amdin -->
                  <div class="flex flex-col">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">
                      Choisis la role d'admin <tr>*</tr>
                    </label>
                    <select id="type" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                      <option value="" selected>-- Choisis un role</option>
                      <?php
                      $sql = $cnx->prepare("SELECT * from role");
                      $sql->execute();
                      while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                          <option value='$data[id_role]'> $data[description] </option>
                          ";
                      }
                      ?>
                      <!-- end categorie  -->
                    </select>
                  </div>
                  <!-- end form fields input ****************************************************** -->
                  <!-- create & cancel buttons -->
                  <div class="pt-4 flex items-center space-x-4">
                    <a href="<?= $base_url . 'admins/admin.php' ?> " class=" flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md
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