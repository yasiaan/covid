<?php
include "connexion.php";

include "validation_profile.php";

if( !isset($_GET['link']) ){
    error($_SESSION['etudiant_id']);
}

//Recuperation des donnees de cycle et filiere

$sql_cycle = 'SELECT * FROM cycle_info';
$req_cycle = mysqli_query($conn, $sql_cycle);
$sql_filiere = 'SELECT * FROM filiere_info';
$req_filiere = mysqli_query($conn, $sql_filiere);


//Validation de l'inscription ou de la modification
if( isset($_POST['modifier']) ){
    //Recuperation des informations du formulaire
    if( isset($_POST['matricule']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['cycle']) && isset($_POST['filiere']) && isset($_POST['niveau']) && isset($_POST['dateN']) && isset($_POST['sexe']) && isset($_POST['dateI']) ){
        $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $cycle = mysqli_real_escape_string($conn, $_POST['cycle']);
        $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
        $niveau = $_POST['niveau'];
        $dateN = $_POST['dateN'];
        $sexe = $_POST['sexe'];
        $dateI = $_POST['dateI'];
        //Mise à jour des information dans la base de donnees
        $id = $_SESSION['etudiant_id'];
        $sql = "UPDATE etudiants 
                SET matricule = '{$matricule}',
                    nom = '{$nom}',
                    prenom = '{$prenom}',
                    email = '{$email}',
                    cycle_id = '{$cycle}',
                    filiere_id = '{$filiere}',
                    niveau = '{$niveau}',
                    sexe = '{$sexe}',
                    dateN = '{$dateN}',
                    dateI = '{$dateI}',
                    etat_validation = 0
                WHERE id = '{$id}'";
        $result = mysqli_query($conn, $sql);
        if( !$result ){
            exit("Error: " . $sql . "<br>" . mysqli_error($conn));
        }
    }
    //Traitement des fichiers apres modification
    
    $link = mysqli_real_escape_string($conn, $_GET['link']);
    $champs = array('photo', 'cin', 'bac', 'attestation');
    for($i = 0; $i < count($champs); $i++){
        $content_dir = '../etudiants_images/';
        $name_file = $link.'_'.$champs[$i].'.jpg';
        
        if( !empty($_FILES[$champs[$i]]['name']) ){
            $tmp_file = $_FILES[$champs[$i]]['tmp_name'];
            if( !is_uploaded_file($tmp_file)){
                exit("Le fichier est introuvable");
            }
            $type_file = $_FILES[$champs[$i]]['type'];
            $types = array('image/jpg','image/jpeg','image/bmp','image/png');
            if( !in_array($type_file, $types)){
                exit("Le fichier n'est pas une image");
            }
            unlink('../etudiants_images/'.$link.'_'.$champs[$i].'.jpg');                                     
            $name_file = $_FILES[$champs[$i]]['name'];
            if( !move_uploaded_file($tmp_file, $content_dir.$name_file)){
                exit("Impossible de copier le fichier");
            }
        }
        $new_name = $matricule."_".$nom."_".$champs[$i].".jpg";
        rename($content_dir.$name_file, $content_dir.$new_name);
    }
    $_SESSION['success'] = 'Modification effectuée avec succès';
    header("Location: ../vue/profile.php?id=".$_SESSION['etudiant_id']);
}
