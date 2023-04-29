<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 <style>
 *{
  box-sizing: border-box;
  padding: 0;
  margin: 0;
 }
.premier{
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}
.expo_facturation{

    display: flex;
    flex-direction: row;
   
}
table{
    border: 2px solid rgba(232, 28, 103, 0.886);
}
 </style>
  </head>

<body>
  <section class="premier">

<div class="row">

<div class="">
<table>
  
        <h5>Exposant</h5>
        <tr>
          <th scopre="col">Société</th>
          <?php echo"<td>$data1[nom]</td>" ?>
        </tr>
        <tr>
          <th scopre="col">Adresse</th>
          <?php echo"<td>$data1[adresse]</td>" ?>
        </tr>
          
        <tr>
          <th scopre="col">Code postal</th>
          <?php echo"<td>$data1[code_postal]</td>" ?>
        </tr>
        <tr>
          <th scopre="col">Ville</th>
          <?php echo"<td>$data1[ville]</td>" ?>
        </tr>
        <h5>Representant</h5>
        <tr>
          <th scopre="col">Nom</th>
          <?php echo"<td>$data1[nom_responsable]</td>" ?>
        </tr>
        <tr>
          <th scopre="col">Prénom</th>
          <?php echo"<td>$data1[prenom]</td>" ?>
        </tr>
       
        <tr>
          <th scopre="col">fonction</th>
          <?php echo"<td>$data1[fonction]</td>" ?>
        </tr>

        <tr>
          <th scopre="col">Email</th>
          <?php echo"<td>$data1[email]</td>" ?>
        </tr>
       
        <tr>
          <th scopre="col">Tel</th>
          <?php echo"<td>$data1[telephone]</td>" ?>
        </tr>
       

       
    
    </table>
</div>
<div class="facturation">
    <table id="myTable" >
  
  <h5>Adresse de facturation</h5>
  <tr>
   <input type="checkbox"  value="">
  </tr>
  <tr>
    <th scopre="col">Prénom</th>
    <?php echo"<td>$data2[prenom]</td>" ?>
  </tr>
  <tr>
    <th scopre="col">Nom</th>
    <?php echo"<td>$data2[nom]</td>" ?>
  </tr>
  <tr>
    <th scopre="col">Email</th>
    <?php echo"<td>$data2[email]</td>" ?>
  </tr>
  <tr>
    <th scopre="col">Ville</th>
    <?php echo"<td>$data2[ville]</td>" ?>
  </tr>

  <tr>
    <th scopre="col">Adresse</th>
    <?php echo"<td>$data2[adresse]</td>" ?>
  </tr>
    
  <tr>
    <th scopre="col">Code postal</th>
    <?php echo"<td>$data2[code_postal]</td>" ?>
  </tr>
 

 
  <tr>
    <th scopre="col">Tel</th>
    <?php echo"<td>$data1[telephone]</td>" ?>
  </tr>
 

 

</table>
</div>
</div>

<div class="offres">
<table class="table table-striped table-hover text-center" id="myTable" >
<label> Forum </label>



<h5><?php echo"$data4[nom]" ?></h5>
  
  
  <h5>Les offres choisi</h5>
  
  <tr>
          <th scope="col">Nom de l'offre</th>
          <th scope="col">Description</th>
          <th scope="col">Prix</th>
        
          
        </tr>
 <?php
  echo $id_commande;
  $query3=$cnx->prepare("SELECT * from offre
  inner join detail_commande on detail_commande.id_offre=offre.id_offre
  where id_commande='$id_commande'");
  $query3->execute();

  $offre_choisi=array();
  while($row=$query3->fetch(PDO::FETCH_ASSOC)){
      $offre_choisi[]=$row['id_offre'];
  }

  $query5=$cnx->prepare("SELECT * from offre where visible='1'");
  $query5->execute();
  $data3=$query5->fetch(PDO::FETCH_ASSOC);
  

 while($data3=$query5->fetch(PDO::FETCH_ASSOC)){
 
    echo "
    <br>
    <tr>
          <td>$data3[nom]</td>
          <td>$data3[description]</td>
          <td>$data3[prix_unitaire]</td>";
          echo '<input type="checkbox" name="offres[]" value="' . $data3['id_offre'] . '" ' . (in_array($data3['id_offre'], $offre_choisi) ? "checked" : "") . '>';

 echo "</tr>";  
 }


 ?>

 

</table>
</div>
</section>
</body>