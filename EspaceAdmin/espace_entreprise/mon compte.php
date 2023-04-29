 <?php


include("../conf.php");
session_start();

include("alert_message.php");
include("side.php");

$id_responsable=$_SESSION['id_responsable'];

$sql=$cnx->prepare("SELECT * from entreprise where id_responsable='$id_responsable'");
$sql->execute();
$data=$sql->fetch(PDO::FETCH_ASSOC);


    
if (isset($_POST['submit'])) {
    if(empty($nom) || !empty($secteur) || empty($ville)  || empty($code_postal ) || empty($adresse ) || empty($telephone )) {

    $nom =htmlspecialchars(strtolower(trim($_POST['nom'])));
    $secteur = htmlspecialchars(strtolower(trim($_POST['secteur'])));
    $ville = htmlspecialchars(strtolower(trim($_POST['ville'])));
    $code_postal =htmlspecialchars(strtolower(trim($_POST['code_postal'])));
    $adresse = htmlspecialchars(strtolower(trim($_POST['adresse'])));
    $telephone = htmlspecialchars(strtolower(trim($_POST['telephone'])));

    $logo = $_FILES['file'];
    $uniqueID=uniqid();
    $logo_name = $uniqueID.$logo['name'];
    $logo_tmp = $logo['tmp_name'];
    $logo_size = $logo['size'];
 
 
    
if($sql->rowCount()>0){
    $query1 = $cnx->prepare("UPDATE entreprise set nom='$nom', secteur='$secteur', ville='$ville', code_postal='$code_postal', adresse='$adresse', telephone='$telephone',logo='$logo_name' where id_responsable='$id_responsable'");
 
    if($query1->execute()){
        $_SESSION["message_e"]="Entreprise enregistrée avec success !";
 
          
      }
      else{
        $_SESSION["message_e"]="L'enregistrement de l'entreprise a échoué";
      }
}else{
   
        $query =$cnx->prepare("INSERT INTO entreprise (nom, secteur, ville, code_postal, adresse, telephone,logo,id_responsable) VALUES('$nom', '$secteur', '$ville', '$code_postal', '$adresse', '$telephone','$logo_name','$id_responsable')");
        $query0 =$cnx->prepare("UPDATE adresse_facturation set ville='$ville', code_postal='$code_postal', adresse='$adresse' where id_responsable='$id_responsable'");
        move_uploaded_file($logo_tmp, "../uploads/{$logo_name}");
      
      
    if(  $query->execute() && $query0->execute()){
        $_SESSION["message_e"]="Entreprise enregistrée avec success !";
     
        
        
      }
      else{
        $_SESSION["message_e"]="L'enregistrement de l'entreprise a échoué";
        
     
      }
}
     
    } else{
       
    }
}

$sql2=$cnx->prepare("SELECT * from adresse_facturation where id_responsable='$id_responsable'");
$sql2->execute();
$info=$sql2->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['valider'])) {
    if(empty($nom)) {

    $nom_f =htmlspecialchars(strtolower(trim($_POST['nom_f'])));
  
    $email_f = htmlspecialchars(strtolower(trim($_POST['email_f'])));
    $prenom_f = htmlspecialchars(strtolower(trim($_POST['prenom_f'])));
    $ville_f = htmlspecialchars(strtolower(trim($_POST['ville_f'])));
    $code_postal_f =htmlspecialchars(strtolower(trim($_POST['code_postal_f'])));
    $adresse_f = htmlspecialchars(strtolower(trim($_POST['adresse_f'])));
    $telephone_f = htmlspecialchars(strtolower(trim($_POST['telephone_f'])));


    
if( $sql2->rowCount()>0){
    $query3=$cnx->prepare( "UPDATE adresse_facturation set nom='$nom_f', prenom='$prenom_f', ville='$ville_f', code_postal=' $code_postal_f', adresse='$adresse_f', telephone='$telephone_f',email='$email_f' where id_responsable='$id_responsable'");
    if( $query3->execute()){
        $_SESSION["message_e"]="Adresse de facturation est modifié avec success !";
      }
      else{
        $_SESSION["message_e"]="L'enregistrement de l'adresse de facturation a échoué";
      }
}else{
    $query2 =$cnx->prepare("INSERT into adresse_facturation (nom,prenom,email,adresse,ville,code_postal,telephone,id_responsable) values('$nom_f','$prenom_f','$email_f','$adresse_f','$ville_f','$code_postal_f','$telephone_f','$id_responsable')");
    if( $query2->execute()){
        $_SESSION["message_e"]="L'adresse de facturation est enregistrée avec success !";
    
      }
      else{
        $_SESSION["message_e"]="L'enregistrement de l'adresse de facturation a échoué";
    
     
      }
}
     
    } 
}

//*********** */
$sql4=$cnx->prepare("SELECT * from responsable where id_responsable='$id_responsable'");
$sql4->execute();
$row=$sql4->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['valider_r'])) {
    if(!empty($_POST['nom_r'])) {

    $nom_r =htmlspecialchars(strtolower(trim($_POST['nom_r'])));
  
    $email_r = htmlspecialchars(strtolower(trim($_POST['email_r'])));
    $prenom_r = htmlspecialchars(strtolower(trim($_POST['prenom_r'])));
 
    $fonction_r = htmlspecialchars(strtolower(trim($_POST['fonction_r'])));
    $telephone_r = htmlspecialchars(strtolower(trim($_POST['telephone_r'])));

    //changement de mdp
    $ancien_password=htmlspecialchars(strtolower(trim($_POST['ancien_password'])));
    $nv_password=htmlspecialchars(strtolower(trim($_POST['nv_password'])));
    $cnv_password=htmlspecialchars(strtolower(trim($_POST['cnv_password'])));
    $password_hashed=password_hash($nv_password, PASSWORD_BCRYPT);
    if(password_verify($ancien_password,$row['PASSWORD']) && isset($nv_password)){
        if($cnv_password==$nv_password){
            $sql5=$cnx->prepare("UPDATE responsable set PASSWORD='$password_hashed'");
            $sql5->execute();
        }else{
            $_SESSION["message_e"]="Le mot de passe et la confirmation du mot de passe ne sont pas identhiques ! ";
        }
    }
    

    $sql3=$cnx->prepare( "UPDATE responsable set nom='$nom_r', prenom='$prenom_r', email='$email_r', fonction='$fonction_r', telephone='$telephone_r' where id_responsable='$id_responsable'");
    
    if( $sql3->execute()){
        $_SESSION["message_e"]="Les informations du responsable sont modifiées avec succes  !";
      }
      else{
        $_SESSION["message_e"]="L'enregistrement des informations du responsable a échoué";
      }
}
     
    } 

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> <!-- //to close errorMessage -->
    <!-- Boxicons -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- botstrap-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <title>Mon compte</title>
</head>

<body>
    
<div class="home-content">

<div class="container">
  <div class="text-center mb-4">
   
    <p class="text-muted">Completer le formulaire ci-dessous pour enregistrer les informations de votre entreprise</p>
  </div>
  <div class="container d-flex-row justify-content-center">
    <h4>Informations sur l'entreprise</h4>
    <form  method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
            <div class="mb-3">
                <label class="form-label">Nom de l'entreprise:</label>
                    <input class="form-control" type="text" name="nom"  required  value="<?php if(isset($data['nom'])){echo  $data['nom'];} ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Secteur:</label>
                    <input type="text" class="form-control" name="secteur"  required
                    value="<?php if(isset($data['secteur'])){echo  $data['secteur'];} ?>" >
            </div>

            <div class="mb-3">
                <label class="form-label">Ville:</label>
                    <input type="text" class="form-control" name="ville" 
                    required
                    value="<?php if(isset($data['ville'])){echo  $data['ville'];} ?>" >
            </div>

            <div class="mb-3">
                <label class="form-label">Code postal:</label>
                    <input type="number" class="form-control" name="code_postal" required value="<?php if(isset($data['code_postal'])){echo  $data['code_postal'];} ?>" >
                    </div>
                <div class="mb-3">
                <label class="form-label">Adresse:</label>
                    <input type="text" class="form-control" 
                    name="adresse" 
                    value="<?php if(isset($data['adresse'])){echo  $data['adresse'];} ?>"
                    required >
                    </div>
                <div class=" mb-3">
                <label class="form-label">Telephone:</label>
                    <input type="number" class="form-control" name="telephone" 
                    required
                   value="<?php if(isset($data['telephone'])){echo  $data['telephone'];} ?>">

            </div>
            
            <div class="mb-3">
                <label class="form-label">Logo de l'entreprise:</label>
                <input type="file" value="<?php echo $data['logo']?>" name="file">
            </div>
 
            <div class="mb-3" >
                    <button type="submit" name="submit" class="btn btn-outline-info ">Modifier l'entreprise</button>
            </div>
        </form>
        <form method="post" style="width:50vw; min-width:300px; margin-bottom:20px">  
            <h4>Information sur l'adresse de facturation</h4>

            <div class="mb-3">
                <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="nom_f"  required
                    value="<?php if(isset($info['nom'])){echo  $info['nom'];} ?>" >
            </div>

            <div class="mb-3">
                <label class="form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom_f"  required
                    value="<?php if(isset($info['prenom'])){echo  $info['prenom'];} ?>" />
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail :</label>
                    <input type="email" class="form-control" name="email_f" required
                    value="<?php if(isset($info['email'])){echo  $info['email'];} ?>" />
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse :</label>
                    <input type="text" class="form-control" name="adresse_f"  required
                    value="<?php if(isset($info['adresse'])){echo  $info['adresse'];} ?>" >
            </div>
            <div class="mb-3">
                <label class="form-label">Ville :</label>
                    <input type="text" class="form-control" name="ville_f"  required
                    value="<?php if(isset($info['ville'])){echo  $info['ville'];} ?>" >
            </div>
            <div class="mb-3">
                <label class="form-label">Code postal :</label>
                    <input type="text" class="form-control" name="code_postal_f"  required
                    value="<?php if(isset($info['code_postal'])){echo  $info['code_postal'];} ?>" >
            </div>
            <div class="mb-3">
                <label class="form-label">Telephone :</label>
                    <input type="text" class="form-control" name="telephone_f"  required
                    value="<?php if(isset($info['telephone'])){echo  $info['telephone'];} ?>" >
            </div>
            <div class="mb-3" >
                    <button type="submit"  id="valide" name="valider" class="btn btn-outline-info" onclick="reload_site()">Enregistrer l'adresse</button>
            </div>
            </form>

            <form method="post" style="width:50vw; min-width:300px; margin-bottom:20px">  
            <h4>Mes informations:</h4>

            <div class="mb-3">
                <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="nom_r"  required
                    value="<?php if(isset($row['nom'])){echo  $row['nom'];} ?>" >
            </div>

            <div class="mb-3">
                <label class="form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenom_r"  required
                    value="<?php if(isset($row['prenom'])){echo  $row['prenom'];} ?>" />
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail :</label>
                    <input type="email" class="form-control" name="email_r" required
                    value="<?php if(isset($row['email'])){echo  $row['email'];} ?>" />
            </div>
            <div class="mb-3">
                <label class="form-label">Fonction :</label>
                    <input type="text" class="form-control" name="fonction_r"  required
                    value="<?php if(isset($row['fonction'])){echo  $row['fonction'];} ?>" >
            </div>
        
            <div class="mb-3">
                <label class="form-label">Telephone :</label>
                    <input type="text" class="form-control" name="telephone_r"  required
                    value="<?php if(isset($row['telephone'])){echo  $row['telephone'];} ?>" >
            </div>
            <div class="mb-3">
                <label class="form-label">Ancien mot de passe :</label>
                    <input type="password" class="form-control" name="ancien_password"  >
                   
            </div>
            <div class="mb-3">
                <label class="form-label">Nouveau mot de passe :</label>
                    <input type="password" class="form-control" name="nv_password"  >
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmer le nouveau mot de passe :</label>
                    <input type="password" class="form-control" name="cnv_password" >
            </div>
            <div class="mb-5"  >
                    <button type="submit"  id="valide" name="valider_r" class="btn btn-outline-info" onclick="reload_site()">Enregistrer mes informations</button>
      

            </div>
            <div class="mb-5"  >
                    <button type="submit"  id="valide" name="valider_r" class="btn btn-danger" onclick="reload_site()"><a  style="text-decoration:none;color:aliceblue;" href="supp_compte.php">Supprimer mon compte</a></button>
      

            </div>
            </form>
    
    
    
    
    </div>
</div>
<script>
    let btn=document.getElementById('valider')
    function reload_site(){
           setTimeout(location.reload(),3000)
    }
</script>
</body>
</html>