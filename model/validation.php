<?php
session_start();

include "connexion.php";

include "mail/confirmation_mail.php";

$sql = "UPDATE etudiants SET etat_validation = 1 WHERE id = '{$_GET['id']}'";
$req = mysqli_query($conn, $sql);
if( !$req ){
    exit("Error: ". $sql . "<br>" . mysqli_error($conn));
}

$sujet = 'Inscription validée';
$message = '<html>
                <body>
                    <h1 style="text-align:center;"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/INSEA_logo.png" width="12%" style="vertical-align:middle;margin-right:5px;"></h1>
                    <h1 style="text-align:center;">INSEA - <span style="color:green">Validation d\'inscription</span></h1>
                    <h3 style="text-align:center;">Votre demande d\'inscription a été validée avec <span style="color:green">succès</span>.</h3>
                </body>
            </html>';
if ( !envoyer_mail($_GET['email'], $sujet, $message) ){
    $_SESSION['error'] = 'une erreur s\'est produite lors de l\'envoi du courrier. Cliquez <a href="confirmation.php">ici</a> pour le renvoyer';
}

$_SESSION['success'] = 'Inscription validée avec succès';
header("Location: ../vue/index.php");
return;