<?php
session_start();

if( !isset($_SESSION['utilisateur'])){
    header("Location: ../model/deconnexion.php");
}
include "connexion.php";

//Traitement de l'id reçu par la méthode GET
if( isset($_GET['id'])){
    $sql_id = "SELECT id, matricule, nom FROM etudiants";
    $req_id = mysqli_query($conn, $sql_id);
    if( !$req_id ){
        exit("Error: ". $sql_id ."<br>". mysqli_error($conn));
    }
    $check = 0;
    while( $result_id = mysqli_fetch_assoc($req_id) ){
        if( $result_id['id'] == $_GET['id']){
            $check = 1;
            $m = $result_id['matricule'];
            $n = $result_id['nom'];
        }
    }
    if( $check == 0){
        error($link = "../model/deconnexion.php");
    }else{
        if( isset($_GET['link']) ){
            if( $_GET['link'] != $m.'_'.$n ){
                error($_SESSION['etudiant_id']);
            }
        }
    }
}else{
    error($_SESSION['etudiant_id']);
}
//la recupperation des donnees de l'etudiant soit pour la modification ou pour la visualisation de detail
$id = $_GET['id'];
$sql = "SELECT e.matricule, e.nom, e.prenom, e.email, c.cycle, f.filiere, e.niveau, e.sexe, e.dateN, e.dateI, e.etat_validation 
        FROM etudiants e
        JOIN cycle_info c
        JOIN filiere_info f
        ON e.filiere_id = f.filiere_id 
        AND e.cycle_id = c.cycle_id
        WHERE id='{$id}'";
$result = mysqli_query($conn, $sql);
if( !$result ){
    exit("Error: " . $sql . "<br>" . mysqli_error($conn));
}
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
}else{
    if($_SESSION['utilisateur'] == 1){
        $_SESSION['error'] = 'Etudiant introuvable';
        header("Location: ../vue/index.php");
        return;
    }else{
        $_SESSION['error'] = 'Etudiant introuvable';
        header("Location: ../vue/profile.php?id='{$id}'");
        return;
    }
}

//Envoie du message d'erreur

function error($link = "profile.php?id=", $etudiant_id = NULL){
    if($_SESSION['utilisateur'] == 1){
        $_SESSION['error'] = 'Etudiant introuvable';
        header("Location: ../vue/index.php");
        exit();
    }else{
        header("Location: ../vue/".$link.$etudiant_id);
        exit();
    }
}