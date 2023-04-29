
<?php
include("../conf.php");
session_start();
include("alert_message.php");

include("side.php");
echo basename($_SERVER["PHP_SELF"]);


?>
<head>
 
   <title>Forums</title>
  

   <!-- Link to Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <style>
   
   /* Custom styles for this page */
   .cartes{
    display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 0 20px;
  margin-bottom: 26px;


   }
   .carte{
   background-color: white;
   width: 370px;
   height: 160px;
   margin: 10px;
   border-radius: 20px;
  
   }
#one{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
}

   .info{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 10px;
    align-items: flex-start;
    margin-right: 10px;
   }
   .pic img{
    width:150px; 
    height:140px;
     border-radius:20px;
   }


  .action{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: flex-end;
    margin-top: 10px;
   
  }

  .action a{
    text-decoration: none;
    padding: 7px;
    background-color: #c3195d;
    color: white;
    border-radius: 10px;
    
  }

  @media (max-width:420px){
    .carte{
      width: 360px;
   height: 160px;
   margin: 10px;
    }
    img{
      width: 50px;
      height: 50px;
    }
    .pic img{
      width: 90px;
      height:90px;
    }
    .a{
      font-size:10px;
      padding: 3px;
    }
    .action{
      justify-content: space-around;
      align-items:center;
    }
  }
   </style>
</head>
<body>


<div class="container">
<div class="home-content">
        <div class="cartes">
   <?php
  
  $query1=$cnx->prepare("SELECT *  from forum where visible='1'");
  $query1->execute();
while (  $data=$query1->fetch(PDO::FETCH_ASSOC)){
    echo '
    <div class="carte" id="one">
    
    <div class="pic">';
    if($data['photo']==null){
      echo '<img src="images/'.$data['photo'].'"/>';
    }else{
      echo '<img src="images/defaut.jpg"/>';

    }
   
 echo '</div>
    ';
 
    echo   "
    <div class='info'>
    <div> <h4>". $data['nom'].'</h4></div>';
      
    echo  '<div class="infos" style="font-size:15px"><i class="fa-sharp fa-solid fa-location-dot"></i> '.$data['lieu'].'<br><i class="fa-solid fa-calendar-days"></i> <label>'. $data['date_debut_forum'].'<label>' .'</div>
 
    ';

    echo " <div class='action'>
      <div style='font-size:13px; width:50%'><b><a href='forum.php?id_forum=$data[id_forum]'>Voir plus</a></b></div>
     
      <div style='font-size:13px; width:50%'><b><a href='les offres de ce forum.php?id_forum=$data[id_forum]'>Commander</a></b></div>
   
    </div>
     </div>
  </div>





    ";
}

?>

      
     
 
</section>

</body>