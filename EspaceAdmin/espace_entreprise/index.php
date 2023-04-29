<?php
// Démarrage de la session pour maintenir les variables de session
session_start();
// Inclusion du fichier de configuration de la base de données
include("../conf.php");
// Inclusion du fichier d'affichage des messages d'alerte
include("alert_message.php");

// Vérification si le formulaire a été soumis
if(isset($_POST['submit'])){
    // Vérification si tous les champs requis sont remplis
    if(!empty($_POST['nom']) && !empty($_POST['email'])&& !empty($_POST['password'])&& !empty($_POST['cpassword'])){
        // Nettoyage des données et assignation à des variables
        $nom=htmlspecialchars(strtolower(trim($_POST['nom'])));
        $prenom=htmlspecialchars(strtolower(trim($_POST['prenom'])));
        $fonction=htmlspecialchars(strtolower(trim($_POST['fonction'])));
        $telephone=htmlspecialchars(strtolower(trim($_POST['telephone'])));
        $email=htmlspecialchars(strtolower(trim($_POST['email'])));
        $password=htmlspecialchars(strtolower(trim($_POST['password'])));
        $cpassword=htmlspecialchars(strtolower(trim($_POST['cpassword'])));
        
        // Hachage du mot de passe
        $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        // Vérification si les mots de passe correspondent
        if($password==$cpassword){
            // Préparation de la requête d'insertion des données dans la table responsable
            $query=$cnx->prepare("INSERT into responsable (nom,prenom,fonction,email,telephone,PASSWORD) values('$nom','$prenom','$fonction','$email','$telephone','$password_hashed')");
            
            // Exécution de la requête et vérification si l'insertion a réussi
            if ($query->execute()){
                // Récupération de l'id du responsable inscrit dans la table responsable
                $sql=$cnx->prepare("SELECT * from responsable where email='$email'");
                $sql->execute();
                if($sql->rowCount()>0){
                    $data1=$sql->fetch(PDO::FETCH_ASSOC);
                    $id_responsable=$data1['id_responsable'];
                    
                    // Préparation de la requête d'insertion des données dans la table adresse_facturation
                    $query1=$cnx->prepare("INSERT into adresse_facturation (nom,prenom,email,telephone,id_responsable) values('$nom','$prenom','$email','$telephone','$id_responsable')");
                }
                
                // Exécution de la requête et vérification si l'insertion a réussi
                if($query1->execute()){
                    // Inclusion du fichier d'envoi de mail de vérification
                    include("verification_mail.php");
                    
                    // Affichage d'un message de succès
                    echo '
                    <div class="alert alert-success" id="alert">
                          Votre inscription est effectué avec success !
                      </div>
                      
                      <script>
                      let c=document.getElementById("alert")
                      
                      function alert_change(){
                        c.className="rien"
                        c.textContent=""
                      }
                      let time_change
                      setTimeout(alert_change,2500)
                      clearInterval(time_change)
                      </script>
                     ';
                }	
            }else{
                // Affichage d'un message d'erreur
                echo "Votre inscription a echoué !";
            }
        }else{
            // Affichage d'un message d'erreur
            // TODO: ajouter un message d'erreur spécifique pour les mots de passe qui ne correspondent pas
        }
    }else{
        // Affichage d'un message d'erreur
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../administration/logo_ftt.png" type="image/x-icon">

    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="inscription.css" />
    <link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  </head>

    <title>Inscription</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">

        <div class="signin-signup">
          <form action="login.php" method="post" class="sign-in-form">
            <h2 class="title">Connexion</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Emai" name="email"  required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Mot de passe" name="password"  required/>
            </div>
            <input type="submit" value="Se connecter" name="signin" class="btn solid" />
    <a href="mot_de_passe_oublié.php" style="margin-bottom: 20px;">Mot de passe oublié?</a>
            <div class="social-media">
              <a href="https://www.facebook.com/forum.toulouse" target="_blank" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://twitter.com/ForumToulouse" target="_blank" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
             
              <a href="https://www.linkedin.com/company/forumtoulousetechnologies/" target="_blank" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="https://www.instagram.com/forum_toulouse_technologies/" target="_blank" class="social-icon">
              <i class="fab fa-instagram"></i>
                </a>
            </div>
       
          </form>

          <form  class="sign-up-form" method="post" >
            <h2 class="title">Inscription</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nom du responsable" name="nom"  required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Prenom du responsable" name="prenom"  required />
            </div>
            <div class="input-field">
            <i class="fa-duotone fa-user-doctor"></i>
              <input type="text" placeholder="Fonction du responsable" name="fonction"  required />
            </div>
            <div class="input-field">
            <i class="fa-solid fa-phone"></i>
                        <input type="number" placeholder="Telephone" name="telephone"  required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email"  required />
            </div>
      
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Mot de passe" name="password"  required />
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirmation du mot de passe" name="cpassword"  required />
            </div>

            <input type="submit" class="btn" name="submit" value="S'inscrire" />
        
            <div class="social-media">
              <a href="https://www.facebook.com/forum.toulouse" target="_blank" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://twitter.com/ForumToulouse" target="_blank" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
             
              <a href="https://www.linkedin.com/company/forumtoulousetechnologies/" target="_blank" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="https://www.instagram.com/forum_toulouse_technologies/" target="_blank" class="social-icon">
              <i class="fab fa-instagram"></i>
                </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Nouveau encore?</h3>
            <p>
              Inscrivez-vous dès maintenant pour profiter de nos tarifs dès maintenant!
            </p>
            <button class="btn transparent" id="sign-up-btn" >
              S'inscrire
            </button>
          </div>
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Déjà membre?</h3>
            <p>
             Pour se connecter veuillez renseignez votre email et mot de passe pour acceder à votre compte
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Se connecter
            </button>
          </div>
        </div>
      </div>
    </div>

    <script >
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
</script>
  </body>
</html>