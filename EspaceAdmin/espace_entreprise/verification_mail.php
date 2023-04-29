



<?php


include("../conf.php");

use PHPMailer\PHPMailer\PHPMailer;


require_once("../administration/php-mailer/src/PHPMailer.php");
require_once("../administration/php-mailer/src/SMTP.php");
require_once("../administration/php-mailer/src/Exception.php");


if (isset($_POST['submit'])) {
    // Récupérer l'adresse e-mail saisie
    $email= $_POST['email'];
    $token = md5(uniqid(rand(), true));
        
        $query1 =$cnx->prepare("INSERT INTO verify_email (email, token) VALUES ('$email', '$token')");
        $query1->execute();

       

function sendMail($email,$token){

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
 


  $mail->Body = "Bonjour,\n\nCliquez sur ce lien pour vérifier votre adresse mail : http://localhost/extranet_FTT/code/espace_entreprise/mail_verify.php?token=$token";
  ;
  if (!$mail->send()) {
    $_SESSION['message_e']= "mail non envoyé ";
   

}
}
    sendMail($email,$token);
       


        // Afficher un message de confirmation
      //  $_SESSION['message']= "Un e-mail a été envoyé à $email avec des instructions pour verifier votre adresse mail.";
 } 



?>

