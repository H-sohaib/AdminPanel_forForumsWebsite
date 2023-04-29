<?php

if(isset($_SESSION['message'])){

	echo '<div class="alert alert-success" id="alert">';
    echo $_SESSION['message'];
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
unset($_SESSION['message']);



?>