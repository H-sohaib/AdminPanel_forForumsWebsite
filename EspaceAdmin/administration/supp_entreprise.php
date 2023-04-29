<?php
// Inclusion du fichier de configuration
include("../conf.php");

// Démarrage de la session
session_start();

// Inclusion du fichier de gestion des rôles
include("gestion_role.php");

// Inclusion des fichiers nécessaires pour les messages d'alerte et l'interdiction d'accès
require("alert_message.php");
require("interdit.php");

// Récupération de l'id de l'entreprise à supprimer à partir de l'URL
$id_entreprise=$_GET['id_entreprise'];

// Récupération des données à archiver pour chaque commande de l'entreprise à supprimer
$query=$cnx->prepare("SELECT commande.nom_forum ,admin.nom AS nom_admin,entreprise.nom as nom_entreprise,commande.id_commande,commande.date_commande,offre.prix_unitaire,commande.statut as statut_commande,commande.total,offre.nom as nom_offre,offre.id_offre FROM entreprise
inner join commande on entreprise.id_entreprise=commande.id_entreprise
inner join detail_commande on detail_commande.id_commande=commande.id_commande
inner join admin on admin.id_admin=commande.id_admin
INNER JOIN offre ON offre.id_offre=detail_commande.id_offre 
where entreprise.id_entreprise='$id_entreprise';");

// Exécution de la requête
if ($query->execute()) {
    // Récupération des données sous forme de tableau associatif
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
 
    // Boucle sur les données pour les archiver
    foreach ($data as $row) {
        $id_commande = $row['id_commande'];
        $nom_entreprise = $row['nom_entreprise'];
        $nom_forum = $row['nom_forum'];
        $statut_commande = $row['statut_commande'];
        $date_commande = $row['date_commande'];
        $nom_admin = $row['nom_admin'];
        $total = $row['total'];

        // Insertion des données dans la table archive_commande
        $insert1 = $cnx->prepare("INSERT INTO archive_commande (id_commande, nom_entreprise, nom_forum, statut_commande, date_commande, nom_admin, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert1->execute([$id_commande, $nom_entreprise, $nom_forum, $statut_commande, $date_commande, $nom_admin, $total]);

        $id_offre = $row['id_offre'];
        $nom_offre = $row['nom_offre'];
        $prix_unitaire = $row['prix_unitaire'];

        // Insertion des données dans la table archive_details_commandes
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


$sql=$cnx->prepare("DELETE from facture where id_entreprise='$id_entreprise'");
$query2=$cnx->prepare("DELETE from commande where id_entreprise='$id_entreprise'");
$query3=$cnx->prepare("DELETE FROM entreprise WHERE id_entreprise='$id_entreprise'");
$query4=$cnx->prepare("DELETE from facture where id_entreprise='$id_entreprise'");
$query5=$cnx->prepare("DELETE from exposants where id_entreprise='$id_entreprise'");


$sql->execute();
$query1->execute();
$query2->execute();
$query4->execute();
$query5->execute();

if($query3->execute()){
    $_SESSION['message']="L'entreprise a été bien supprimé";
    header("Location:entreprises.php");
}

?>