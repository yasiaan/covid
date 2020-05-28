<?php
session_start();
if( !isset($_SESSION['utilisateur']) || $_SESSION['utilisateur'] != 1){
    header("Location: ../model/deconnexion.php");
}


function table_etudiant($etat_validation){
    include "connexion.php";
    $sql = "SELECT e.id, e.matricule, e.nom, e.prenom, e.email, c.cycle, f.filiere, e.niveau, e.sexe, e.dateN, e.dateI, e.etat_confirmation
            FROM etudiants e
            JOIN cycle_info c
            JOIN filiere_info f
            ON e.filiere_id = f.filiere_id 
            AND e.cycle_id = c.cycle_id
            WHERE e.etat_validation = $etat_validation
            AND e.etat_confirmation = 1";
    $result = mysqli_query($conn, $sql);
    if( !$result){
        exit("Error: " . $sql . "<br>" . mysqli_error($conn));
    }

    if(mysqli_num_rows($result) > 0){
        echo '<table>';
        if( $etat_validation == 0 ){
            echo '<h3>Les demandes d\'inscription reçues</h3>';
        }else{
            echo '<h3>Les demandes d\'inscription validées</h3>';
        }
        echo '<thead>
                <td>Photo</td>
                <td>Matricule</td>
                <td>Nom</td>
                <td>prénom</td>
                <td>Cycle</td>
                <td>Filière</td>
                <td>Niveau</td>';
                if( $etat_validation == 0 ){
                    $cols = 3;
                }else{
                    $cols = 2;
                }
        echo  '<td colspan="'.$cols.'">Actions</td>
            </thead>
            <tbody>';
        while($row = mysqli_fetch_assoc($result)){
            $chemin = '../etudiants_images/'.$row['matricule'].'_'.$row['nom'].'_photo.jpg';
            echo '<tr>
                <td id="photo_profile"><img src="'.$chemin.'" class="photo_profile" width="35vm" height="35vm"></td>
                <td>'.$row['matricule'].'</td>
                <td>'.$row['nom'].'</td>
                <td>'.$row['prenom'].'</td>
                <td>'.$row['cycle'].'</td>
                <td>'.$row['filiere'].'</td>
                <td>'.$row['niveau'].' année</td>
                <td>
                    <a href="../model/validation_supprimer.php?id='.$row['id'].'&link='.$row['matricule'].'_'.$row['nom'].'" title="Refuser" onclick="return window.confirm(\'Confirmation du refus :\');">Refuser</a>
                </td>';
                if( $etat_validation == 0 ){
                    echo '<td>
                            <a href="../model/validation.php?id='.$row['id'].'&email='.$row['email'].'" title="valider">Valider</a>
                          </td>';
                }
            echo '<td>
                    <a href="../vue/profile.php?id='.$row['id'].'" title="profil">Détail étudiant</a>
                  </td>
            </tr>';
        }    
    }else{
        if( $etat_validation != 1 ){
            echo '<h3>Aucune demande d\'inscription reçue</h3>';
        }
    }
}