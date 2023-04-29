<?php
include("../conf.php");
session_start();

$id_entreprise=$_SESSION['id_entreprise'];
$id_responsable=$_SESSION['id_responsable'];
$query=$cnx->prepare("SELECT commande.nom_forum ,admin.nom AS nom_admin,entreprise.nom as nom_entreprise,commande.id_commande,commande.date_commande,offre.prix_unitaire,commande.statut as statut_commande,commande.total,offre.nom as nom_offre,offre.id_offre FROM entreprise
inner join commande on entreprise.id_entreprise=commande.id_entreprise
inner join detail_commande on detail_commande.id_commande=commande.id_commande
inner join admin on admin.id_admin=commande.id_admin
INNER JOIN offre ON offre.id_offre=detail_commande.id_offre 
where entreprise.id_entreprise='$id_entreprise';");
if ($query->execute()) {
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    // Loop over the data and insert into the archive tables
    foreach ($data as $row) {
        $id_commande = $row['id_commande'];
        $nom_entreprise = $row['nom_entreprise'];
        $nom_forum = $row['nom_forum'];
        $statut_commande = $row['statut_commande'];
        $date_commande = $row['date_commande'];
        $nom_admin = $row['nom_admin'];
        $total = $row['total'];

        // Insert into the archive_commande table
        $insert1 = $cnx->prepare("INSERT INTO archive_commande (id_commande, nom_entreprise, nom_forum, statut_commande, date_commande, nom_admin, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert1->execute([$id_commande, $nom_entreprise, $nom_forum, $statut_commande, $date_commande, $nom_admin, $total]);

        $id_offre = $row['id_offre'];
        $nom_offre = $row['nom_offre'];
        $prix_unitaire = $row['prix_unitaire'];

        // Insert into the archive_details_commande table
        $insert2 = $cnx->prepare("INSERT INTO archive_details_commandes (id_commande, id_offre, nom_offre, prix_unitaire) VALUES (?, ?, ?, ?)");
        $insert2->execute([$id_commande, $id_offre, $nom_offre, $prix_unitaire]);
    }
}



$query1=$cnx->prepare("DELETE FROM detail_commande
   WHERE id_commande IN (
   SELECT id_commande FROM commande
   WHERE id_commande IN (
    Select id_commande from commande
    WHERE id_entreprise ='$id_entreprise'))");

$query5=$cnx->prepare("DELETE from exposants where id_entreprise='$id_entreprise'");
$sql=$cnx->prepare("DELETE from facture where id_entreprise='$id_entreprise'");
$query2=$cnx->prepare("DELETE from commande where id_entreprise='$id_entreprise'");
$query3=$cnx->prepare("DELETE FROM entreprise WHERE id_entreprise='$id_entreprise'");
$query4=$cnx->prepare("DELETE from facture where id_entreprise='$id_entreprise'");


$query5->execute();
$sql->execute();
$query1->execute();
$query2->execute();
$query4->execute();



if($query3->execute()){
    $_SESSION['message_e']="Votre compte a été bien supprimé";

}

$sql1=$cnx->prepare("DELETE from adresse_facturation where id_responsable='$id_responsable'");
$sql2=$cnx->prepare("DELETE from responsable where id_responsable='$id_responsable'");
$sql1->execute();
if($sql2->execute()){
    session_destroy();
    header("location:index.php");
}


?>