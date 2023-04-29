
<?php
include("../conf.php");
session_start();
include("alert_message.php");

include("side.php");
$id_forum=$_GET['id_forum'];

?>

<div class="container">
<div class="home-content">
      <div class="container">
   <?php
  
  $query1=$cnx->prepare("SELECT * from forum where id_forum='$id_forum'");
  $query1->execute();

  if($data=$query1->fetch(PDO::FETCH_ASSOC)){
 echo '
 
 <section class="first row" id="first">
      <div class="col-md-5 order-md-1 section-image">';
      if($data['photo']==null){
        echo '<img src="images/'.$data['photo'].'" style= "width: 350px;height: 300px;border-radius:20px"/>';
      }else{
        echo '<img src="images/defaut.jpg" style= "width: 350px;height: 300px;border-radius:20px"/>';
  
      }
  
    echo '</div>
      <div class="col-md-6 order-md-1  section-text" style="text-align:justify;">';
       echo '<h2>'.$data['nom'] .'</h2>';
       echo '<h5>'. $data['lieu'] .' '. $data['date_debut_forum'].'</h5>';
       echo '<p>'.$data['description'].'</p>';
       echo '<h6> La date de fin d\'inscription : '.'<b>'.$data['date_fin_inscription'].'</b>'.'</h6>';
    
      echo '</div>
   </section>
 
 
 
 
 
 
 ';



  
}
echo '
<div class="row" style="margin-top:20px;">
<div class="card" style="width:18rem; margin:10px ;border-radius:20px;">
  <img src="images/63f4a62c548d4pic2.jpg" style="width:100%;height:200px;border-radius:20px;margin-top:5px;" class="card-img-top" >
  <div class="card-body">
    <h5 class="card-title">Plaquette</h5>
    <p class="card-text"></p>
    <a href="#" class="btn btn-secondary" style="background-color:#e84a5f;border:none;">Télécharger</a>
  </div>
</div>
<div class="card" style="width: 18rem;margin:10px;border-radius:20px; ">
<img src="images/63f4a62c548d4pic2.jpg" style="width:100%;height:200px;border-radius:20px;margin-top:5px;" class="card-img-top" >
<div class="card-body">
    <h5 class="card-title">Kit media</h5>
    <p class="card-text"></p>
    <a href="#" class="btn btn-secondary" style="background-color:#e84a5f;border:none;">Télécharger</a>
  </div>
</div>
<div class="card" style="width: 18rem;margin:10px ;border-radius:20px;">
<img src="images/63f4a62c548d4pic2.jpg" style="width:100%;height:200px;border-radius:20px;margin-top:5px;" class="card-img-top" >
<div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text"></p>
    <a href="#" class="btn btn-secondary" style="background-color:#e84a5f;border:none;">Télécharger</a>
  </div>
</div>
</div>';
include("les offres de ce forum.php");
?>
 
 </div>
</div>
</div>


 