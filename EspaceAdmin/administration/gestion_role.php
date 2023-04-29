<?php

// Définissez les niveaux d'accès
define("niveau_zero", 0);
define("niveau_un", 1);
define("niveau_deux", 2);
define("niveau_trois", 3);


// Définissez les pages et leurs niveaux d'accès requis
$pages = array(
    "Les offres de ce forum.php" => niveau_un,
    "tableau de bord.php" => niveau_zero,
    "commandes.php" => niveau_un,
    "details de la commande.php" => niveau_un,
    "offres.php" => niveau_un,
    "entreprise.php" => niveau_un,
    "entreprises.php" => niveau_un,
    "archive des commandes.php" => niveau_un,
    "forums.php" => niveau_un,
    "catégorie.php" => niveau_un,
    "commandes passées.php" => niveau_un,
    "admin.php" => niveau_un,
    "archive details commandes.php" => niveau_un,
    "ajouter_admin.php" => niveau_trois,
    "ajouter_entreprise.php" => niveau_trois,
    "ajouter_forum.php" => niveau_trois,
    "ajouter_catégorie.php" => niveau_trois,
    "ajouter_offre.php" => niveau_deux,
    "ajouter_facture.php" => niveau_trois,
    "modif_admin.php" => niveau_trois,
    "modif_entreprise.php" => niveau_trois,
    "modif_catégorie.php" => niveau_trois,
    "modif_offre.php" => niveau_deux,
    "modif_forum.php" => niveau_trois,
    "supp_entreprise.php" => niveau_trois,
    "supp_forum.php" => niveau_trois,
    "supp_offre.php" => niveau_deux,
    "supp_catégorie.php" => niveau_trois,
    "valider_commande.php" => niveau_deux,
);


$niveau_admin = $_SESSION['role'];
// var_dump($niveau_admin);
// exit;

$page_actuel = basename($_SERVER['PHP_SELF']);

if (!isset($pages[$page_actuel]) || $pages[$page_actuel] > $niveau_admin) {
    header("Location:tableau_bord.php");
    exit();
}
