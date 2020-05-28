<?php
session_start();
include "connexion.php";

include "mail/confirmation_mail.php";

if( !isset($_GET['etudiant_id']) || !is_numeric($_GET['etudiant_id'])){
    header("Location: ../vue/inscription.php");
}

//Récupération du code de confirmation
$sql = "SELECT email, mot_de_passe FROM utilisateur WHERE id='{$_GET['etudiant_id']}'";
$req = mysqli_query($conn, $sql);
if( !$req ){
    exit("Error : ". $sql . "<br>". mysqli_error($conn));
}
if( mysqli_num_rows($req) > 0){
    $result = mysqli_fetch_assoc($req);
}else{
    header("Location: ../vue/utilisateur_connexion.php");
}

$sujet = 'Confirmation de l\'inscription';
if( isset($_SESSION['inscrit']) ){
    if( $_SESSION['inscrit'] == 0 ){
        $message = '<html>
                        <body>
                            <h1 style="text-align:center;"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/INSEA_logo.png" width="12%"></h1>
                            <h1 style="text-align:center;">INSEA - <span style="color:green">Demande d\'inscription</span></h1>
                            <h3 style="text-align:center;">Voici votre code de confirmation : <span style="color: green;">'.$result['mot_de_passe'].'</span>,
                                veuillez l\'entrer <a href="http://localhost/dev.web/Projet_dev_web_2019_2020/vue/confirmation.php?etudiant_id='.$_GET['etudiant_id'].'">ici</a> pour confirmer votre inscription</h3>
                        </body>
                    </html>';
        if ( !envoyer_mail($result['email'], $sujet, $message) ){
            $_SESSION['error'] = 'une erreur s\'est produite lors de l\'envoi du courrier. Cliquez <a href="confirmation.php?etudiant_id='.$_GET['etudiant_id'].'">ici</a> pour le renvoyer';
        }else{
            unset($_SESSION['inscrit']);
        }
    }
}
if( isset($_POST['confirmer']) ){
    if( isset($_POST['code_confirmation']) && isset($_POST['mot_de_passe']) && isset($_POST['mot_de_passe2'])){
        if( $_POST['code_confirmation'] == $result['mot_de_passe'] ){
            if( $_POST['mot_de_passe'] == $_POST['mot_de_passe2'] ){
                $hashed = hash('md5', $_POST['mot_de_passe']);
                $sql = "UPDATE utilisateur SET mot_de_passe='{$hashed}' WHERE id='{$_GET['etudiant_id']}'";
                $req = mysqli_query($conn, $sql);
                if( !$req ){
                    exit("Error : ". $sql . "<br>". mysqli_error($conn));
                }
                $sql_confirm = "UPDATE etudiants SET etat_confirmation = 1 WHERE email='{$result['email']}'";
                $req_confirm = mysqli_query($conn, $sql_confirm);
                if( !$req_confirm ){
                    exit("Error : ". $sql . "<br>". mysqli_error($conn));
                }
                $message = '<html>
                                <body>
                                    <h1 style="text-align:center;"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/INSEA_logo.png" width="12%"></h1>
                                    <h1 style="text-align:center;">INSEA - <span style="color:green">Demande d\'inscription</span></h1>
                                    <h3 style="text-align:center;">Nous avons bien reçu votre demande inscription, nous vous contacterons dans les plus brefs délais.<br>
                                    Cliquez <a href="http://localhost/dev.web/Projet_dev_web_2019_2020/vue/utilisateur_connexion.php">ici</a> pour modifier ou accéder à votre profile.</h3>
                                </body>
                            </html>';
                if ( !envoyer_mail($result['email'], $sujet, $message) ){
                    $_SESSION['error'] = 'une erreur s\'est produite lors de l\'envoi du courrier. Cliquez <a href="confirmation.php">ici</a> pour le renvoyer';
                }
                $_SESSION['success'] = 'Enregistré avec succès.<br>Nous vous contacterons dans les plus brefs délais';
                $sql_id = "SELECT id FROM etudiants WHERE email = '{$result['email']}'";
                $req_id = mysqli_query($conn, $sql_id);
                $result_id = mysqli_fetch_assoc($req_id);
                $_SESSION['etudiant_id'] = $result_id['id'];
                $_SESSION['utilisateur'] = 0;
                header("Location: profile.php?id=".$_SESSION['etudiant_id']);
                return;
            }else{
                $_SESSION['error'] = 'Confirmation de mot de passe incorrecte';
                header("Location: ../vue/confirmation.php?etudiant_id=".$_GET['etudiant_id']);
                exit();
            }
        }else{
            $_SESSION['error'] = 'Code de confirmation "'.$_POST['code_confirmation'].'" est incorrect';
            header("Location: ../vue/confirmation.php?etudiant_id=".$_GET['etudiant_id']);
            exit();
        }
    }
}
