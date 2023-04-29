<?php
// Inclusion du fichier de configuration
include("../conf.php");
// Démarrage de la session
session_start();
// Récupération de l'id du forum depuis l'URL
$id_forum=$_GET['id_forum'];
// Requête pour récupérer les informations du forum sélectionné
$info1=$cnx->prepare("SELECT * from forum where id_forum='$id_forum'");
$info1->execute();
$info=$info1->fetch(PDO::FETCH_ASSOC);
// Récupération du nom du forum
$nom_forum=$info['nom'];
// Récupération de l'id de l'entreprise à partir de la session
$id_entreprise=$_SESSION['id_entreprise'];

// Vérification si le formulaire a été soumis et si des offres ont été sélectionnées
if(isset($_POST['submit']) && isset($_POST['offres'])){
    // Vérification si l'utilisateur est connecté en tant qu'entreprise
    if(isset($_SESSION['id_entreprise'])){

        // Récupération de la date courante
        $date_commande=date('y-m-d');
        // Génération d'un identifiant unique pour la commande
        $uniqueId=uniqid();

        // Récupération des offres sélectionnées dans le formulaire
        if(isset($_POST['offres'])){
            $offres=$_POST['offres'];
        }
        // Conversion du tableau d'offres en une chaîne de caractères séparée par des virgules
        $id = implode(',', $offres);
        // Requête pour calculer le prix total des offres sélectionnées
        $sql =$cnx->prepare("SELECT SUM(prix_unitaire) as total_prix FROM offre WHERE id_offre IN ($id)");
        $sql->execute();
        if($result=$sql->fetch(PDO::FETCH_ASSOC)){
            // Récupération du prix total
            $total=$result['total_prix'];
        }

        // Requête pour insérer une nouvelle commande dans la base de données
        $query=$cnx->prepare("INSERT into commande(date_commande,total,id_entreprise,nom_forum,unique_id) values('$date_commande','$total','$id_entreprise','$nom_forum','$uniqueId')");

        // Exécution de la requête d'insertion de la commande dans la base de données
        if($query->execute()){
            // Requête pour récupérer les informations de la commande insérée
            $sql=$cnx->prepare("SELECT * from commande where unique_id='$uniqueId'");
            $sql->execute();
            $data=$sql->fetch(PDO::FETCH_ASSOC);
            // Récupération de l'id de la commande
            $id_commande=$data['id_commande'];

            // Boucle pour insérer les détails de la commande (offres sélectionnées) dans la table detail_commande
            if(isset($offres)){
                foreach($offres as $offre){
                    $query2 =$cnx->prepare("INSERT INTO detail_commande (id_commande,id_offre) VALUES('$data[id_commande]','$offre')");
                    $query2->execute();
                }

                // Inclusion du fichier PHP pour générer un PDF à partir du HTML
                require_once "generer_pdf.php";

                // Enregistrement du fichier PDF dans le répertoire "uploads"
                $id2=uniqid();
                $file_name=$id2.$fichier;
                $file_location = '../uploads/' .$file_name;
                file_put_contents($file_location, $dompdf->output());
            
            // Stream the PDF file to the browser
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $file_name . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($file_location);
            $pdf=$cnx->prepare("UPDATE commande set bon_de_commande='$file_name'");
            $pdf->execute();
            
        }
        $_SESSION['message_e']="la commande a été bien enregistrer, veuillez renseigner les bon de commande signé dans la partie mes commandes ";
        header("Location:mes commandes.php");


      
    }else{
        $_SESSION['message_e']="la validation de la commande a échoué";
    }
}else{
    $_SESSION['message_e']="Veuillez renseigner les informations de votre entreprise et l'adresse de facturation si different !";
    header("Location:mon compte.php");
}
}else{
    $_SESSION['message_e']="Vous n'avez séléctionné une offre!";
    header("Location:forums.php");
}
?>