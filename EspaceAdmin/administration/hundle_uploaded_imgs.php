<?php
function hundle_uploaded_imgs()
{
  if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
    $image = $_FILES['file'];
    if ($image['error'] === 0) {
      $mime_type = getimagesize($image['tmp_name'])['mime'];
      if ($mime_type != 'image/jpeg' && $mime_type != 'image/png' && $mime_type != 'image/gif') {
        // handle error - file is not a valid image 
        setcookie('error', "Format d'image invalide , format accepeté ( .jpeg , .png , .gif )", time() + ALERT_EXPIRE_TIME);
        header("Location:ajouter_forum.php");
        exit;
      } elseif ($image['size'] > 2 * 1024 * 1024) {
        setcookie('error', "L'image téléchargée ne doit pas dépasser 2 Mo", time() + ALERT_EXPIRE_TIME);
        header("Location:ajouter_forum.php");
        exit;
      }
      // create a unique file name 
      $img_name = uniqid() . '.' . htmlspecialchars($image['name']);
      // move the image to the asset folder
      if (move_uploaded_file($image['tmp_name'], __DIR__ . '\uploads\\' . $img_name)) {
        return __DIR__ . '\uploads\\' . $img_name;
      } else {
        // handle error
        setcookie('error', "Erreur survenue lors du stockage d'image dans le serveur", time() + ALERT_EXPIRE_TIME);
        header("Location:ajouter_forum.php");
        exit;
      }
    } else {
      setcookie('error', "Erreur survenue lors du téléchargement de l'image.", time() + ALERT_EXPIRE_TIME);
      header("Location:ajouter_forum.php");
      exit;
    }
  } else {
    return '';
  }
}
