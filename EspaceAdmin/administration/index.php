<?php
// Inclusion du fichier de configuration
include("../conf.php");
// Démarrage de la session
session_start();
// Inclusion du fichier d'alertes
include('alert_message.php');

// Vérification de l'envoi du formulaire
if (isset($_POST['submit'])) {
  // Vérification que tous les champs sont remplis
  if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Nettoyage et formatage des entrées de formulaire
    $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
    $prenom = htmlspecialchars(strtolower(trim($_POST['prenom'])));
    $email = htmlspecialchars(strtolower(trim($_POST['email'])));

    // Hashage du mot de passe
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Préparation de la requête SQL pour insérer les données dans la table "admin"
    $query = $cnx->prepare("INSERT into admin (nom,prenom,email,password) values('$nom','$prenom','$email','$password')");

    // Exécution de la requête SQL
    if ($query->execute()) {
      // Affichage d'un message d'alerte en cas de succès
      echo '
      <div class="alert alert-success" id="alert">
          Votre inscription est effectué avec success !
      </div>

      <script>
      let c=document.getElementById("alert")

      // Fonction pour supprimer le message d\'alerte après un certain temps
      function alert_change(){
        c.className="rien"
        c.textContent=""
      }

      // Définition du temps d\'affichage de l\'alerte
      let time_change
      setTimeout(alert_change,2500)
      clearInterval(time_change)
      </script>
     ';
    } else {
      // Affichage d'un message d'erreur en cas d'échec de la requête SQL
      echo "Votre inscription a echoué !";
    }
  } else {
    // Affichage d'un message d'erreur si tous les champs ne sont pas remplis
    echo "veuiller remplir tous les champs";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta codecharset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>

  <title>Inscription</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='inscription.css'>

</head>

<body>

  <div class="container" id="container">
    <!-- register Form *************************************************************************-->
    <div class="form-container sign-up-container">
      <!-- action="inscription.php" -->
      <form method="POST" action="">
        <h1>Creation du compte</h1>

        <img src="logo_ftt.png" style="height:100px;width:100px" />


        <input type="text" placeholder="nom" name="nom" />

        <input type="text" placeholder="Prénom" name="prenom" />
        <input type="email" placeholder="Email" name="email" />
        <input type="password" placeholder="Mot de passe" name="password" />


        <input type="submit" name="submit" value="S'inscrire">
      </form>
    </div>
    <!-- Login Form *************************************************************************** -->
    <div class="form-container sign-in-container">
      <form action="login.php" method="POST">
        <h1>Se connecter</h1>
        <div class="social-container">
          <img src="logo_ftt.png" style="height:100px;width:100px" />
        </div>

        <input type="email" placeholder="Email" name="email" />
        <input type="password" placeholder="Mot de passe" name="password" />

        <input type="submit" name="submit" value="Se connecter">
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Bienvenue à nouveau!</h1>
          <p>Pour se connecter veuillez renseignez votre email et mot de passe</p>
          <button class="ghost" id="signIn">Connextion</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Bienvenue sur votre espace admin</h1>
          <p>Veuillez completer le formulaire d'inscription </p>
          <button class="ghost" id="signUp">Inscription</button>
        </div>
      </div>
    </div>
  </div>


  <script>
  const signUpButton = document.getElementById('signUp');
  const signInButton = document.getElementById('signIn');
  const container = document.getElementById('container');

  signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
  });

  signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
  });
  </script>
</body>

</html>