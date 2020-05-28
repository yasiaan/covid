<?php
session_start();
session_destroy();
header("Location: ../utilisateur_connexion.php");

?>