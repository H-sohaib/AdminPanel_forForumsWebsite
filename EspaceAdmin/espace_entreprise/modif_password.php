<?php
include("../conf.php");
session_start();
include("alert_message.php");
if (isset($_GET['token'])) {
    // Récupérer le token de réinitialisation de mot de passe depuis l'URL
    $token =$_GET['token'];

    // Vérifier si le token est valide et non expiré
    $query= $cnx->prepare("SELECT * FROM password_reset_tokens WHERE token='$token'") ;
    $query->execute();
   if($row=$query->fetch(PDO::FETCH_ASSOC)){
    $email=$row['email'];
    
   } 
 

    if ($query->rowCount() == 1) {
     if(isset($_POST['submit'])){
       
       $password=htmlspecialchars(strtolower(trim($_POST['password'])));
       $cpassword=htmlspecialchars(strtolower(trim($_POST['cpassword'])));
       if($cpassword==$password){
       
        $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $query2=$cnx->prepare("UPDATE responsable set PASSWORD='$password_hashed' where email='$email'");
     if($query2->execute()){
        header("location:index.php");
        $_SESSION['message_e']="Mot de passe a été modifié avec succes !";

     }
       }

    

     }
    }else{
        $_SESSION['message_e']="Le lien n'est plus valable";
    }
    
    }else{
        $_SESSION['message_e']="token non retrouvé";
    }


?>





<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Modification du mot de passe</title>
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
        font-size: 20px;
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
     
        transition: 0.4s;
        border-radius: 25px;
        color:white;
        background-color: rgb(207, 30, 113);
    }
    input[type=submit]:hover{
     cursor: pointer;
    }
    input[type=password] {
   
        border: none;
        border-bottom: 2px solid #cd186f;
        border-top: 0px;
        border-radius: 0px;
        width: 350px;
   
        margin-bottom: 20px;
        color: #EEEEEE;
        font-size: 14px;
    }
    form{
        display: flex;
        flex-direction: column;
    }
</style>
</head>
<body style="background-color: #f2f3f8;">
    <section>
        <img src="../administration/logo_ftt.png" style="width: 100px; height:100px;">
        <div class="premier">
            
            <h1>
                Vous pouvez modifier de votre mot de passe
            </h1>
            <p>
              Pour votre prochaine connexion veuillez utiliser votre email avec ce mot de passe
            </p>
            <form method="post">
            <label for="email">Mot de passe:</label>
                <input type="password" name="password" placeholder="Votre mot de passe" required>
                <label for="email">Confirmation du mot de passe:</label>
                <input type="password" name="cpassword" placeholder="Confirmation de votre mot de passe" required>
                <input type="submit" name="submit" value="Réinitialiser le mot de passe">
            </form>
        </div>
        
        
    </section>
 
</body>
</html>