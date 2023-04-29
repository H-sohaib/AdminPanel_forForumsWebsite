<?php

use PHPMailer\PHPMailer\PHPMailer;


require_once("php-mailer/src/PHPMailer.php");
require_once("php-mailer/src/SMTP.php");
require_once("php-mailer/src/Exception.php");





function sendMail()
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

  $des=$_SESSION['email_admin'];
  $mail->addAddress($des);

  $mail->isHTML(true);
  $mail->Subject ="Forum Toulouse Technologie";
  $html = file_get_contents('template.php');
  

  $mail->Body = $html;
  if ($mail->send()) {
    echo "mail envoyé";
   } else {
     echo "mail non envoyé";
   }

  

}

    sendMail();
  
?>
