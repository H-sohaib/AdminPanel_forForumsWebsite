

<?php

if(isset($_SESSION['id_exposant'])){
  
    $query1=$cnx->prepare("SELECT * from exposants where id_exposant='$id_exposant'");
    $query1->execute();
 
    $data1=$query1->fetch(PDO::FETCH_ASSOC);

  
    unset($_SESSION['id_exposant']);
}





?>
 <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="exposants.css" />
  </head>
<body>
<section>



<table class="table  " id="myTable" >
  <tr>
  
    <th scopre="col">Nom</th>
    <?php echo"<td>$data1[nom]</td>" ?>
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
</section>
</body>