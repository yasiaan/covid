<?php
session_start();
session_destroy();
header("Location: ../vue/utilisateur_connexion.php");

?>