<?php
session_start();
include "connexion.php";
//Recuperation des donnees de cycle et filiere

$sql_cycle = 'SELECT * FROM cycle_info';
$req_cycle = mysqli_query($conn, $sql_cycle);
$sql_filiere = 'SELECT * FROM filiere_info';
$req_filiere = mysqli_query($conn, $sql_filiere);

//Validation de l'inscription
if( isset($_POST['enregistrer']) ){
    //Recuperation des informations du formulaire
    if( isset($_POST['matricule']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['cycle']) && isset($_POST['filiere']) && isset($_POST['niveau']) && isset($_POST['dateN']) && isset($_POST['sexe']) && isset($_POST['dateI']) ){
        if( !is_numeric($_POST['matricule'])){
            error_inscrit('Le champ matricule doit être numérique');
        }
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if( !preg_match('#^[0-9a-zA-Z._\-]+@[0-9a-zA-z._\-]{2,}\.[a-zA-Z]{2,4}$#',$email)){
            error_inscrit('Email invalide');
        }
        $req = mysqli_query($conn, "SELECT matricule, email FROM etudiants");
        if( !$req ){
            exit("Error: ". mysqli_error($conn));
        }
        while( $result = mysqli_fetch_assoc($req) ){
            if( $result['email'] == $_POST['email'] ){
                error_inscrit('Email existe déjà');
            }
            if( $result['matricule'] == $_POST['matricule'] ){
                error_inscrit('Matricule existe déjà');
            }
        }
        $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $cycle = mysqli_real_escape_string($conn, $_POST['cycle']);
        $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
        $niveau = $_POST['niveau'];
        $dateN = $_POST['dateN'];
        $sexe = $_POST['sexe'];
        $dateI = $_POST['dateI'];
        //Insertion des information dans la table etudiants
        $sql = "INSERT INTO etudiants( matricule, nom, prenom, email, cycle_id, filiere_id, niveau, sexe, dateN, dateI, etat_validation, etat_confirmation)
            VALUES( '{$matricule}', '{$nom}', '{$prenom}', '{$email}', '{$cycle}', '{$filiere}', '{$niveau}', '{$sexe}', '{$dateN}', '{$dateI}', 0, 0)";
        $result = mysqli_query($conn, $sql);
        if( !$result ){
            exit("Error: " . $sql . "<br>" . mysqli_error($conn));
        }
    }
    //Traitement des fichiers
    if(isset($_FILES['photo']) && isset($_FILES['cin']) && isset($_FILES['bac']) && isset($_FILES['attestation'])){
        $champs = array('photo', 'cin', 'bac', 'attestation');
        for($i = 0; $i <=3; $i++){
            $content_dir = '../etudiants_images/';
            $tmp_file = $_FILES[$champs[$i]]['tmp_name'];
            if( !is_uploaded_file($tmp_file)){
                exit("Le fichier est introuvable");
            }
            $type_file = $_FILES[$champs[$i]]['type'];
            $types = array('image/jpg','image/jpeg','image/bmp','image/png');
            if( !in_array($type_file, $types)){
                exit("Le fichier n'est pas une image");
            }
            $name_file = $_FILES[$champs[$i]]['name'];
            if( !move_uploaded_file($tmp_file, $content_dir.$name_file)){
                exit("Impossible de copier le fichier");
            }
            $new_name = $matricule."_".$nom."_".$champs[$i].".jpg";
            rename($content_dir.$name_file, $content_dir.$new_name);
        }
    }
    //Génération d'un code de confirmation aléatoire
    $confirmation = '';
    for($i = 1 ; $i <= 6 ; $i++){
        $confirmation .= mt_rand(1,9);
    }
    //Insertion des information dans la table utilisateur
    $sql = "INSERT INTO utilisateur(email, mot_de_passe, admin) 
                    VALUES('{$email}', '{$confirmation}', 0)";
    $req = mysqli_query($conn, $sql);
    if( !$req ){
        exit("Error : ". $sql . "<br>". mysqli_error($conn));
    }
    $sql_id = "SELECT id FROM utilisateur ORDER BY id DESC LIMIT 1";
    $req_id = mysqli_query($conn, $sql_id);
    if( !$req_id ){
        exit("Error: ". $sql_id ."<br>". mysqli_error($conn));
    }
    $result = mysqli_fetch_assoc($req_id);
    $_SESSION['inscrit'] = 0;
    header("Location: ../vue/confirmation.php?etudiant_id=".$result['id']);
}
//Erreur de saisie
function error_inscrit( $message ){
    $_SESSION['error'] = $message;
    header("Location: ../vue/inscription.php");
    exit();
}