<?php
if (@$_SERVER['HTTPS'])
  $base_url = "https://" . $_SERVER['HTTP_HOST'] . "/Website/EspaceAdmin/administration/";
else
  $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Website/EspaceAdmin/administration/";

$paths  =  ['admins', 'categorie_offre', 'conferences', 'forums', 'offres'];
function contains($str, array $arr)
{
  foreach ($arr as $a) {
    if (stripos($str, $a) !== false) return true;
  }
  return false;
}

// create constante of the assets folder path for each script
if (contains($_SERVER['PHP_SELF'], $paths)) :
  $ASSETS_PATH = "../../../asset/";
  $path_pref = '../';
else :
  $ASSETS_PATH = "../../asset/";
  $path_pref = '';
endif;


const ALERT_EXPIRE_TIME = 2 ;  