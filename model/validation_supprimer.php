<?php
include "connexion.php";

include "validation_profile.php";

include "mail/confirmation_mail.php";

//Suppression d'un etudiant
if( !empty($_GET['link']) ){
    $link = mysqli_real_escape_string($conn, $_GET['link']);
    $champs = array('photo', 'cin', 'bac', 'attestation');
    for($i = 0; $i<=3; $i++){
        unlink('../etudiants_images/'.$link.'_'.$champs[$i].'.jpg');
    }
    $sql_etudiant = "DELETE FROM etudiants WHERE id='{$_GET['id']}'";
    if( !mysqli_query($conn, $sql_etudiant)){
        exit("Error: " . $sql . "<br>" . mysqli_error($conn));
    }
    $sql_utilisateur = "DELETE FROM utilisateur WHERE email='{$row['email']}' and admin=0";
    if( !mysqli_query($conn, $sql_utilisateur)){
        exit("Error: " . $sql . "<br>" . mysqli_error($conn));
    }
    if( $_SESSION['utilisateur'] == 1 ){
        $sujet = 'Inscription refusée';
        $message = '<html>
                        <body>
                            <h1 style="text-align:center;"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/INSEA_logo.png" width="12%"></h1>
                            <h1 style="text-align:center;">INSEA - <span style="color:green">Demande d\'inscription</span></h1>
                            <h3 style="text-align:center;">En réponse à votre inscription, nous sommes au regret de devoir vous informer que celle-ci n\'a pas été retenue.</h3>
                        </body>
                    </html>';
        if ( !envoyer_mail($row['email'], $sujet, $message) ){
            $_SESSION['success'] = 'Inscription refusée';
            $_SESSION['error'] = 'une erreur s\'est produite lors de l\'envoi du courrier à l\'étudiant refusé';
            header("Location: ../vue/index.php");
            return;
        }else{
            $_SESSION['success'] = 'Inscription refusée avec succès';
            header("Location: ../vue/index.php");
            return;
        }
    }else{
        header("Location: deconnexion.php");
    }
}
