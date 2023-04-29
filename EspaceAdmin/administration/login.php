<?php
// $hash = password_hash('test', PASSWORD_BCRYPT);
// echo $hash;
// var_dump(password_verify('test', $hash));
require("../conf.php"); // inclure un fichier de configuration de la base de données
session_start(); // démarrer une session PHP pour stocker des données utilisateur

if (isset($_POST['submit'])) { // vérifier si le formulaire de connexion a été soumis

  // vérifier si les champs email et mot de passe ont été remplis
  if (!empty($_POST['email']) && !empty($_POST['password'])) {

    // nettoyer et sécuriser les données entrées par l'utilisateur
    $email = htmlspecialchars(strtolower(trim($_POST['email'])));
    $password = htmlspecialchars(strtolower(trim($_POST['password'])));

    // préparer une requête SQL pour récupérer les informations de l'administrateur correspondant à l'email fourni
    $query = $cnx->prepare("SELECT * from admin where email='$email'");
    $query->execute();

    // si l'email existe dans la base de données
    if ($query->rowCount() > 0) {

      // récupérer les données de l'administrateur
      $data = $query->fetch(PDO::FETCH_ASSOC);


      // vérifier si le mot de passe entré correspond au mot de passe stocké dans la base de données
      if (password_verify($password, $data['PASSWORD'])) {
        // stocker les informations de l'administrateur dans la session PHP
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['nom_admin'] = $data['nom'];
        $_SESSION['prenom_admin'] = $data['prenom'];
        $_SESSION['email_admin'] = $data['email'];

        // si l'administrateur a un rôle associé, récupérer les informations du rôle dans la base de données
        if ($data['id_role'] != NULL) {
          $sql = $cnx->prepare("SELECT * from role where id_role='$data[id_role]'");
          if ($sql->execute()) {
            $info = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['role'] = $info['niveau'];
            // var_dump($info['niveau']);
            // exit;
          }
        }

        // rediriger l'utilisateur vers la page de tableau de bord
        // header("Location:tableauBord.php");
        header("Location:gestion_role.php");
      } else { // si le mot de passe est incorrect

        // afficher un message d'erreur dans la session PHP
        $_SESSION['message'] = "Mot de passe ou email incorrect !";

        // rediriger l'utilisateur vers la page d'inscription
        header("Location:index.php");
      }
    } else { // si l'email n'existe pas dans la base de données

      // afficher un message d'erreur dans la session PHP
      $_SESSION['message'] = "aucun compte n'est associé à cette adresse mail !";

      // rediriger l'utilisateur vers la page d'inscription
      header("Location:index.php");
    }
  } else { // si les champs email et mot de passe ne sont pas remplis

    // afficher un message d'erreur dans la session PHP
    $_SESSION['message'] = "Veuillez remplir tous les champs !";

    // rediriger l'utilisateur vers la page d'inscription
    header("Location:index.php");
  }
}
