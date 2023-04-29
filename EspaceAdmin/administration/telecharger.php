<?php
if(!empty($_GET['file'])){
    $fileName  = basename($_GET['file']);
    $filePath  = "../uploads/".$fileName;
    
    if(!empty($fileName) && file_exists($filePath)){
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($filePath);
        exit;
    }
    else{
        echo "Le pdf n'existe ou il s'agit pas d'un pdf";
    }
}else{
    $_SESSION['message']="Votre facture n'est pas généré encore !";
    header("location:../espace_entreprise/mes commandes passées.php");
}

