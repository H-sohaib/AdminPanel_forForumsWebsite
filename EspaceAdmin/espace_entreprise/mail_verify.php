<?php

include("../conf.php");

if(isset($_GET['token'])){
    
    $token=$_GET['token'];
    $sql=$cnx->prepare("SELECT * from verify_email where token='$token'");
    $sql->execute();
   if($data=$sql->fetch(PDO::FETCH_ASSOC)){
    $email=$data['email'];
   } 
   
    if($sql->rowCount()>=1){
      
        $sql2=$cnx->prepare("UPDATE responsable set verify='1' where email='$email' ");
        $sql2->execute();
        header("location:index.php");
      //  $_SESSION['message_e']="Votre compte a été bien vérifié vous pouvez vous connecter à votre compte !";
    }
}


















?>