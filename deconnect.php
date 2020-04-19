<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("index.php");
include("login.php");
}


  // Détruire la session.
  if(session_destroy())
  {
    // Redirection vers la page de connexion
    header("Location: login.php");
  }
?>
