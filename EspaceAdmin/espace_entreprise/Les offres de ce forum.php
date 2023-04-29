

<?php
include("../conf.php");

if (basename($_SERVER["PHP_SELF"]) == "les offres de ce forum.php") {
  session_start();
  include("side.php");
}

$id_forum = $_GET['id_forum'];

$query2 = $cnx->prepare(
  "SELECT * FROM offre
    INNER JOIN forums_offres ON offre.id_offre=forums_offres.id_offre
    WHERE forums_offres.id_forum='$id_forum' && id_type_offre=13"
);
$query3 = $cnx->prepare(
  "SELECT * FROM offre
    INNER JOIN forums_offres ON offre.id_offre=forums_offres.id_offre
    WHERE forums_offres.id_forum='$id_forum' && id_type_offre=14"
);
$query4 = $cnx->prepare(
  "SELECT * FROM offre
    INNER JOIN forums_offres ON offre.id_offre=forums_offres.id_offre
    WHERE forums_offres.id_forum='$id_forum' && id_type_offre=15"
);
$query5 = $cnx->prepare(
  "SELECT * FROM offre
    INNER JOIN forums_offres ON offre.id_offre=forums_offres.id_offre
    WHERE forums_offres.id_forum='$id_forum' && id_type_offre=16"
);
$query6 = $cnx->prepare(
  "SELECT * FROM offre
    INNER JOIN forums_offres ON offre.id_offre=forums_offres.id_offre
    WHERE forums_offres.id_forum='$id_forum' && id_type_offre=17"
);

$query2->execute();
$query3->execute();
$query4->execute();
$query5->execute();
$query6->execute();

echo '<div class="container">  
<div class="home-content">
  <div class="container d-flex  justify-content-center align-items-center">
    <form method="POST" action="commander.php?id_forum='.$id_forum.'" class="mt-4">';

    echo "<h4 style='color:#fe4e6e'>Pack:</h4><br>";
    if($query2->rowCount()>0){
      echo '<div class="row">';
      while ($data2=$query2->fetch(PDO::FETCH_ASSOC)) {
        echo '
          <div class="col-md-4 text-center">
            <div class="form-check " style="border-radius:10px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; margin:10px">
              <input  style="width:20px;border:2px solid black" class="form-check-input" type="checkbox" value="'.$data2['id_offre'].'" name="offres[]">
              <label class="form-check-label">
                <h5>'.$data2['nom'].'</h5>
                <p style="text-align:justify">Description: '.$data2['description'].'</p>
                <p>Prix: '.$data2['prix_unitaire'].'€</p>
              </label>
            </div>
          </div>
        ';
      }
      echo '</div>';
    }else{
      echo '
     
            <p>Aucun offre n\'est liée à cette catégorie</p>
     
      ';
    }
    
echo '<h4 class="mb-4 mt-5" style="color:#fe4e6e">Expositions virtuelle:</h4>';
if($query3->rowCount()>0){
  echo '<div class="row">';
  while ($data3=$query3->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <div class="col-md-4 text-center">
    <div class="form-check " style="border-radius:10px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; margin:10px">
      <input  style="width:20px;border:2px solid black" class="form-check-input" type="checkbox" value="'.$data3['id_offre'].'" name="offres[]">
          <label class="form-check-label">
            <h5>'.$data3['nom'].'</h5>
            <p style="text-align:justify">Description: '.$data3['description'].'</p>
            <p>Prix: '.$data3['prix_unitaire'].'€</p>
          </label>
        </div>
      </div>
    ';
  }
  echo '</div>';
}else{
  echo '
 
    <p>Aucun offre n\'est liée à cette catégorie</p>

  
  ';
}


echo '<h4 class="mb-4 mt-5" style="color:#fe4e6e">Expositions physique:</h4>';
if($query4->rowCount()>0){
  echo '<div class="row">';
  while ($data4=$query4->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <div class="col-md-4 text-center">
    <div class="form-check " style="border-radius:10px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; margin:10px">
      <input  style="width:20px;border:2px solid black" class="form-check-input" type="checkbox" value="'.$data4['id_offre'].'" name="offres[]">
          <label class="form-check-label">
            <h5>'.$data4['nom'].'</h5>
            <p style="text-align:justify">Description: '.$data4['description'].'</p>
            <p>Prix: '.$data4['prix_unitaire'].'€</p>
          </label>
        </div>
      </div>
    ';
  }
  echo '</div>';
}else{
  echo '

    <p>Aucun offre n\'est liée à cette catégorie</p>
 
  
  ';
}

echo '<h4 class="mb-4 mt-5" style="color:#fe4e6e">Visibilité:</h4>';
if($query5->rowCount()>0){
  echo '<div class="row">';
  while ($data5=$query5->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <div class="col-md-4 text-center">
    <div class="form-check " style="border-radius:10px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; margin:10px">
      <input  style="width:20px;border:2px solid black" class="form-check-input" type="checkbox" value="'.$data5['id_offre'].'" name="offres[]">
          <label class="form-check-label">
            <h5>'.$data5['nom'].'</h5>
            <p style="text-align:justify">Description: '.$data5['description'].'</p>
            <p>Prix: '.$data5['prix_unitaire'].'€</p>
          </label>
        </div>
      </div>
    ';
  }
  echo '</div>';
}else{
  echo '

    <p>Aucun offre n\'est liée à cette catégorie</p>
 
  
  ';
}

echo '<h4 class="mb-4 mt-5" style="color:#fe4e6e">Amenagement Stand:</h4>';
if($query6->rowCount()>0){
  echo '<div class="row">';
  while ($data6=$query6->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <div class="col-md-4 text-center">
    <div class="form-check " style="border-radius:10px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; margin:10px">
      <input  style="width:20px;border:2px solid black" class="form-check-input" type="checkbox" value="'.$data6['id_offre'].'" name="offres[]">
          <label class="form-check-label">
            <h5>'.$data6['nom'].'</h5>
            <p style="text-align:justify">Description: '.$data6['description'].'</p>
            <p>Prix: '.$data6['prix_unitaire'].'€</p>
          </label>
        </div>
      </div>
    ';
  }
  echo '</div>
  ';
}else{
  echo '

      <p>Aucun offre n\'est liée à cette catégorie</p>

  ';
}
echo '<div class="text-center" style="width:100%"><button  style="margin-bottom:15px;border:none;background-color:#c54c82"type="submit" name="submit" class="btn btn-success btn-lg center ">Commander</button></div>';
echo "</form>
</div>
</div>
</div>";
