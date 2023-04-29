



<?php


include("../conf.php");
session_start();
include("alert_message.php");

use PHPMailer\PHPMailer\PHPMailer;


require_once("../administration/php-mailer/src/PHPMailer.php");
require_once("../administration/php-mailer/src/SMTP.php");
require_once("../administration/php-mailer/src/Exception.php");


if (isset($_POST['submit'])) {
    // Récupérer l'adresse e-mail saisie
    $email= $_POST['email'];

    // Vérifier si l'adresse e-mail existe dans la base de données
    $query = $cnx->prepare("SELECT * FROM responsable WHERE email='$email'");
    $query->execute();

    if ($query->rowCount()>=1) {
        // Générer un lien unique pour la réinitialisation du mot de passe
        $token = md5(uniqid(rand(), true));
        
        $query1 =$cnx->prepare("INSERT INTO password_reset_tokens (email, token, expiration) VALUES ('$email', '$token', DATE_ADD(NOW(), INTERVAL 30 MINUTE))");
        $query1->execute();

        // Envoyer un e-mail contenant le lien de réinitialisation du mot de passe
       

function sendMail($email,$token)
{

 $myemail="salahor20@gmail.com";
 $mypassword = "dxflgqqyipkyspor";

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = $myemail;
  $mail->Password = $mypassword;
  $mail->Port = 587;

  $mail->setFrom($myemail, "Forum Toulouse Technologies");
  $mail->addReplyTo("salah.ouramdan@forum-toulouse.fr", "Responsable Forum Technologie");


  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject ="Forum Toulouse Technologie";
 


  $mail->Body = "Bonjour,\n\nCliquez sur ce lien pour réinitialiser votre mot de passe : http://localhost/extranet_FTT/code/espace_entreprise/modif_password.php?token=$token";
  ;
  if (!$mail->send()) {
    $_SESSION['message_e']="mail non envoyé ";
   

  

}
}
    sendMail($email,$token);
       


        // Afficher un message de confirmation
        $_SESSION['message_e']="Un e-mail a été envoyé à $email avec des instructions pour réinitialiser votre mot de passe.";
    } else {
        // Afficher un message d'erreur si l'adresse e-mail n'existe pas dans la base de données
        $_SESSION['message_e']= "Cette adresse e-mail n'est pas associée à un compte.";
    }
}


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Réinitialisation du mot de passe</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">
<style>
  
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Open Sans';
    }
    section{
        width: 100%;
        height: 100vh;
        display: flex;
       flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .premier{
        width: 450px;
        height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: white;
        text-align: center;
        padding: 20px;
        border-radius: 20px;
    }
    .premier h1{
        font-size: 25px;
        margin-bottom: 10px;
    }
    .premier p{
        font-size: 13px;
        margin-bottom: 40px;
    }
    input[type=submit]{
        text-decoration: none;
        border: 1px solid rgb(207, 30, 113);
        padding: 10px 25px;
        margin-top: 10px;
        transition: 0.4s;
        border-radius: 25px;
        color:white;
        background-color: rgb(207, 30, 113);
    }
    input[type=submit]:hover{
     cursor: pointer;
    }
    input[type=email] {
   
        border: none;
        border-bottom: 2px solid #cd186f;
        border-top: 0px;
        border-radius: 0px;
        width: 350px;
        margin-top: 20px;
        margin-bottom: 20px;
        color: #EEEEEE;
        font-size: 14px;
    }
</style>
</head>
<body style="background-color: #f2f3f8;">
    <section>
        <img src="../administration/logo_ftt.png" style="width: 100px; height:100px;">
        <div class="premier">
            
            <h1>
                Vous avez demandé la réinitialisation de votre mot de passe
            </h1>
            <p>
                On vous enverrai un lien dans l'adresse mail que vous allez renseigner !
                Ensuite,pensez à modifier votre mot de passe 
            </p>
            <form method="post">
                <label for="email">Adresse e-mail :</label>
                <input type="email" name="email" placeholder="Votre adresse mail" required>
                <input type="submit" name="submit" value="Réinitialiser le mot de passe">
            </form>
        </div>
        
        
    </section>
 
</body>
</html>