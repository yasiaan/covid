<?php
include "../model/validation_modifier.php";

include "../model/nav.php";
?>
        <div>
            <h1 class="titre">Modification des informations de l'étudiant<?php if($row['sexe'] == 'F'){echo 'e';}; echo ' : <span style="color:rgb(3, 146, 103);">'.$row['nom'].' '.$row['prenom'].'</span>'; ?></h1><br>
            <span>
                <a href="profile.php?id=<?php echo $_SESSION['etudiant_id']; ?>" title="Annulation" class="btnInsAnn"><input type="button" name="annuler" id="annuler" value="Anuuler"></a>
            <span>
            
            <form action="modifier.php?id=<?php echo $_GET['id'].'&link='.$row['matricule'].'_'.$row['nom']; ?>" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td id="first">
                            <label for="photo">Photo :</label>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_photo.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_photo.jpg"; ?>" id="profile" title="Photo de <?php echo $row['nom']; ?>" height="90vm" width="90vm"><br>
                            </a>
                            <input type="file" name="photo" id="photo" onchange="document.getElementById('profile').src=window.URL.createObjectURL(this.files[0])">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="matricule">Matricule :</label>
                            <input type="text" name="matricule" value="<?php echo $row['matricule']; ?>" id="matricule" placeholder="Num matricule" required >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" value="<?php echo $row['nom']; ?>" id="nom" placeholder="Votre nom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>" id="prenom" placeholder="Votre prénom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email :</label>
                            <input type="text" name="email" value="<?php echo $row['email']; ?>" id="email" size="26"  placeholder="Votre email" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cycle">Cycle :</label>
                            <select name="cycle" id="cycle" required>
                                <?php
                                $selected = false;
                                while($cycle = mysqli_fetch_assoc($req_cycle)){
                                    if($row['cycle'] == $cycle['cycle']){$selected = 'selected';};
                                    echo '<option value="'.$cycle['cycle_id'].'" '.$selected.'>'.$cycle['cycle'].'</option>';
                                    $selected = false;
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filiere">Filière :</label>
                            <select name="filiere" id="filiere" required>
                                <?php
                                $selected = false;
                                while($filiere = mysqli_fetch_assoc($req_filiere)){
                                    if($row['filiere'] == $filiere['filiere']){$selected = 'selected';};
                                    echo '<option value="'.$filiere['filiere_id'].'" '.$selected.'>'.$filiere['filiere'].'</option>';
                                    $selected = false;
                                }
                                ?>
                            </select>
                        </td>
                    <tr>
                        <td>
                            <p>Niveau :
                            <?php
                            for($i = 1; $i <= 3; $i++){
                                $checked = false;
                                if($row['niveau'] == $i){$checked = 'checked';}
                                echo '<label for="'.$i.'A">'.$i.' année</label><input type="radio" name="niveau" id="'.$i.'A" value="'.$i.'" '.$checked.' required>';
                                $checked = false;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateN">Date de naissance :</label>
                            <input type="date" value="<?php echo $row['dateN']; ?>" name="dateN" id="dateN" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Sexe :
                            <label for="M">Masculin</label><input type="radio" name="sexe" id="M" value="1" <?php if($row['sexe'] == 1){echo 'checked';}; ?> required>
                            <label for="F">Féminin</label><input type="radio" name="sexe" id="F" value="0" <?php if($row['sexe'] == 0){echo 'checked';}; ?> required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateI">Date d'inscription :</label>
                            <input type="date" value="<?php echo $row['dateI']; ?>" name="dateI" id="dateI" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="bac">Copie du Baccalauréat :</label><br>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_bac.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_bac.jpg"; ?>" id="bac" class="fichier" title="Baccalauréat de <?php echo $row['nom']; ?>" width="20%"><br>
                            </a><br>
                            <input type="file" name="bac" onchange="document.getElementById('bac').src=window.URL.createObjectURL(this.files[0])">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cin">Copie de la CIN :</label><br>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_cin.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_cin.jpg"; ?>" id="cin" class="fichier" title="CIN de <?php echo $row['nom']; ?>" width="20%"><br>
                            </a><br>
                            <input type="file" name="cin" onchange="document.getElementById('cin').src=window.URL.createObjectURL(this.files[0])">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="attestation">Attestation de réussite (CNC,DEUGS ou Licence) :</label><br>
                            <a href="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_attestation.jpg"; ?>" target="_blank">
                                <img src="../etudiants_images/<?php echo $row['matricule']."_".$row['nom']."_attestation.jpg"; ?>" id="attestation" class="fichier" title="Attestation de <?php echo $row['nom']; ?>" width="20%"><br>
                            </a><br>
                            <input type="file" name="attestation" onchange="document.getElementById('attestation').src=window.URL.createObjectURL(this.files[0])">
                        </td>
                    </tr>
                    <tr>
                        <td class="fin">
                            <input type="submit" name="modifier" id="modifier" value="Enregistrer">
                        </td>
                    </tr>
                </table>
                
            </form>
        </div>
<?php include "../model/footer.php"; ?>