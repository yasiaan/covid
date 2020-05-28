<?php
include "../model/validation_profile.php";

include "../model/nav.php";

?>
        <div>
            <?php
            if( $_SESSION['utilisateur'] == 1 ){
                $s = false;
                if($row['sexe'] == '0' ){$s = 'e';};
                echo '<h1 class="titre">Les informations de l\'étudiant'.$s.' <span style="color:rgb(3, 146, 103);">'.$row['nom'].' '.$row['prenom'].'</span></h1><br>';
                
                echo '<a href="../model/validation_supprimer.php?id='.$_GET['id'].'&link='.$row['matricule'].'_'.$row['nom'].'" title="Refuser" class="btnInsAnn" onclick=" return window.confirm(\'Confirmation du refus :\');" ><input type="button" value="Refuser" ></a>';
                if( $row['etat_validation'] == 0 ){
                    echo '<a href="../model/validation.php?id='.$_GET['id'].'&email='.$row['email'].'" title="valider" class="btnInsAnn"><input type="button" value="Valider" ></a>';
                }
                echo '<a href="index.php" title="Acceuil" class="btnInsAnn"><input type="button" value="Acceuil" ></a>';
            }else{
                $s = 'Mme';
                if( $row['sexe'] == '1' ){$s = 'Mr';};
                echo '<h1 class="titre">Bienvenue '.$s.' <span style="color:rgb(3, 146, 103);">'.$row['nom'].' '.$row['prenom'].'</span></h1><br>';
                if(isset($_SESSION['error'])){
                    echo '<h3 id="error">'.$_SESSION['error'].'</h3>';
                    unset($_SESSION['error']);
                }elseif(isset($_SESSION['success'])){
                    echo '<h3>'.$_SESSION['success'].'</h3>';
                    unset($_SESSION['success']);
                }
                if( $row['etat_validation'] == 0 ){
                    echo '<h3>Inscription en cours de traitement</h3>';
                }else{
                    echo '<h3>Inscription validée</h3>';
                }
                echo '<a href="modifier.php?id='.$_GET['id'].'&link='.$row['matricule'].'_'.$row['nom'].'" title="Modifier" class="btnInsAnn"><input type="button" value="Modifier" ></a>';
                echo '<a href="../model/validation_supprimer.php?id='.$_GET['id'].'&link='.$row['matricule'].'_'.$row['nom'].'" title="Supprimer" class="btnInsAnn" onclick=" return window.confirm(\'Voulez-vous vraiment supprimer la demande :\');" ><input type="button" value="Supprimer" ></a>';
                echo '<a href="../model/deconnexion.php" title="Déconnexion" class="btnInsAnn"><input type="button" value="Déconnexion" ></a>';
            }
            ?>
            <table>
                    <tr>
                        <td id="first">
                            <label for="photo">Photo :</label>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_photo.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_photo.jpg"; ?>" id="profile" title="Photo de <?php echo $row['nom']; ?>" height="90vm" width="90vm"><br>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="matricule">Matricule : </label><?php echo $row['matricule']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nom">Nom : </label><?php echo $row['nom']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="prenom">Prénom : </label><?php echo $row['prenom']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email :</label><?php echo $row['email']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cycle">Cycle : </label><?php echo $row['cycle']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filiere">Filière : </label><?php echo $row['filiere']; ?>
                        </td>
                    <tr>
                        <td>
                            <p>Niveau : <?php echo $row['niveau']." année"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateN">Date de naissance : </label><?php echo $row['dateN']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Sexe : <?php if($row['sexe'] == 1){echo 'Masculin';}else{echo 'Féminin';}; ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateI">Date d'inscription : </label><?php echo $row['dateI']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="bac">Copie du Baccalauréat :</label><br>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_bac.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_bac.jpg"; ?>" class="fichier" title="Baccalauréat de <?php echo $row['nom']; ?>" width="20%"><br>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cin">Copie de la CIN :</label><br>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_cin.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_cin.jpg"; ?>" class="fichier" title="CIN de <?php echo $row['nom']; ?>" width="20%"><br>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="attestation">Attestation de réussite (CNC,DEUGS ou Licence) :</label><br>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_attestation.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_attestation.jpg"; ?>" class="fichier" title="Attestation de <?php echo $row['nom']; ?>" width="20%"><br>
                            </a>
                        </td>
                    </tr>
            </table>
        </div>
<?php include "../model/footer.php"; ?>