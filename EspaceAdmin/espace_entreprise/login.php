<?php
require("../conf.php");
session_start();
if(isset($_POST['signin'])){
  if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email=htmlspecialchars(strtolower(trim($_POST['email'])));
    $password=htmlspecialchars(strtolower(trim($_POST['password'])));

       $query=$cnx->prepare("SELECT * from responsable where email='$email'");
       $query->execute();
       if($query->rowCount()>0){
        $data=$query->fetch(PDO::FETCH_ASSOC);
        
        $query1=$cnx->prepare("INSERT into adresse_facturation (nom,prenom,email,telephone,id_responsable) values('$nom','$prenom','$email','$telephone','$id_responsable')");
        $query1->execute();
   
        if(password_verify($password,$data['PASSWORD']) && $data['verify']==1){
          $_SESSION['id_responsable']=$data['id_responsable'];
          $_SESSION['nom_responsable']=$data['nom'];
          $_SESSION['prenom_responsable']=$data['prenom'];
          $_SESSION['email_responsable']=$data['email'];
          
          header("Location:accueil.php");
        }else{
          echo '<div class="alert alert-success" id="alert">';
          echo "Mot de passe ou email est incorrecte";
         echo '</div>
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
        //  $_SESSION['message_e']="aucun compte n'est associé à cette adresse mail !";
          header("Location:index.php");
       }
  }else{
  //  $_SESSION['message_e']="Veuillez remplir tous les champs !";
   header("Location:index.php");
  }
}

?>
