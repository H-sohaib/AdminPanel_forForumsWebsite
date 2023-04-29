<?php

session_start();
include("../conf.php");
include("gestion_role.php");

$id_entreprise=$_GET['id_entreprise'];
require("interdit.php");

$sql=$cnx->prepare("SELECT * from entreprise where id_entreprise='$id_entreprise'");
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

           
  

        $query =$cnx->prepare( "UPDATE entreprise set nom='$nom ', secteur= '$secteur', ville='$ville', code_postal=' $code_postal', adresse='$adresse', telephone='$telephone' where id_entreprise=$id_entreprise");
       if($query->execute()){
            $_SESSION["message"]="Entreprise modifiée avec success !";
           header("Location: entreprises.php");
        
          }
          else{
            $_SESSION["message"]="La modification de l'entreprise à échoué";
          
         
          }
    } else{
       
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
    <title>Ajouter une entreprise</title>
</head>

<body>
    
<div class="home-content">

      <nav class="navbar navbar-light justify-content-center fs-1 mb-5 text-white" style="background:linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);" >Informations sur l'entreprise</nav>
<div class="container">
  <div class="text-center mb-4">
   
    <h4>Ajouter une nouvelle entreprise</h4>
    <p class="text-muted">Completer le formulaire ci-dessous pour ajouter une entreprise</p>
  </div>
  <div class="container d-flex justify-content-center"><form  method="post" style="width:50vw; min-width:300px;">
<!-- test it it's empty -->
    

        <form method="post" style="width:50vw; min-width:300px;">

            <div class="mb-3">
                <label class="form-label">Nom de l'entreprise:</label>
                    <input class="form-control" type="text" name="nom"  required  value="<?php echo  $data['nom'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Secteur:</label>
                    <input type="text" class="form-control" name="secteur"  required
                    value="<?php echo  $data['secteur'] ?>" >
            </div>

            <div class="mb-3">
                <label class="form-label">Ville:</label>
                    <input type="text" class="form-control" name="ville" 
                    required
                    value="<?php echo  $data['ville'] ?>" >
            </div>

            <div class="mb-3">
                <label class="form-label">Code postal:</label>
                    <input type="number" class="form-control" name="code_postal" required value="<?php echo  $data['code_postal'] ?>" >
                    </div>
                <div class="mb-3">
                <label class="form-label">Adresse:</label>
                    <input type="text" class="form-control" 
                    name="adresse" 
                    value="<?php echo  $data['adresse'] ?>"
                    required >
                    </div>
                <div class=" mb-3">
                <label class="form-label">Telephone:</label>
                    <input type="number" class="form-control" name="telephone" 
                    required
                   value="<?php echo $data['telephone'] ?>">

            </div>
          

                    <button type="submit" name="submit" class="btn btn-success btn-lg ">Modifier l'entreprise</button>
                
        </form></div>
</div>


<script>
  document.getElementById("file").value = "<?php echo $data['logo']?>";
</script>
</body>
</html>