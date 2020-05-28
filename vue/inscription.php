<?php
include "../model/validation_inscription.php";

include "../model/nav.php";
?>
        <div>
            <span>
                <h1 class="titre">INSEA - Inscription en ligne</h1><br>
                <a href="utilisateur_connexion.php" title="Annulation" class="btnInsAnn"><input type="button" name="annuler" id="annuler" value="Annuler" ></a>
            </span>
            <?php 
            if(isset($_SESSION['error'])){
                echo '<h3 id="error">'.$_SESSION['error'].'</h3>';
                unset($_SESSION['error']);
            }
            ?>
            <form action="inscription.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td id="first">
                            <label for="photo">Photo :</label>
                            <img src="../images/profile_picture.png" id="profile" height="90vm" width="90vm"><br>
                            <input type="file" name="photo" id="photo" onchange="document.getElementById('profile').src=window.URL.createObjectURL(this.files[0])" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="matricule">Matricule :</label>
                            <input type="text" name="matricule" id="matricule" placeholder="Num matricule" required >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email :</label>
                            <input type="text" placeholder="Votre email" name="email" id="email" size="26" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cycle">Cycle :</label>
                            <select name="cycle" id="cycle" required>
                                <option value="" selected disabled hidden>--sélectionnez--</option>
                                <?php
                                while($cycle = mysqli_fetch_assoc($req_cycle)){
                                    echo '<option value="'.$cycle['cycle_id'].'">'.$cycle['cycle'].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filiere">Filière :</label>
                            <select name="filiere" id="filiere" required>
                                <option value="" selected disabled hidden>--sélectionnez--</option>
                                <?php
                                while($filiere = mysqli_fetch_assoc($req_filiere)){
                                    echo '<option value="'.$filiere['filiere_id'].'">'.$filiere['filiere'].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    <tr>
                        <td>
                            <p>Niveau :
                            <label for="1A">1 année</label><input type="radio" name="niveau" id="1A" value="1" required>
                            <label for="2A">2 année</label><input type="radio" name="niveau" id="2A" value="2" required>
                            <label for="3A">3 année</label><input type="radio" name="niveau" id="3A" value="3" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateN">Date de naissance :</label>
                            <input type="date" name="dateN" id="dateN" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Sexe :
                            <label for="M">Masculin</label><input type="radio" name="sexe" id="M" value="1" required>
                            <label for="F">Féminin</label><input type="radio" name="sexe" id="F" value="0" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateI">Date d'inscription :</label>
                            <input type="date" name="dateI" id="dateI" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="bac">Copie du Baccalauréat :</label><br>
                            <img src="" class="fichier" id="bac" width="20%"><br>
                            <input type="file" name="bac" onchange="document.getElementById('bac').src=window.URL.createObjectURL(this.files[0])" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cin">Copie de la CIN :</label><br>
                            <img src="" class="fichier" id="cin" width="20%"><br>
                            <input type="file" name="cin" onchange="document.getElementById('cin').src=window.URL.createObjectURL(this.files[0])" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="attestation">Attestation de réussite (CNC,DEUGS ou Licence) :</label><br>
                            <img src="" class="fichier" id="attestation" width="25%"><br>
                            <input type="file" name="attestation" onchange="document.getElementById('attestation').src=window.URL.createObjectURL(this.files[0])" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="fin">
                            <input type="submit" name="enregistrer" id="enregistrer" value="Enregistrer">
                        </td>
                    </tr>
                    <tr>
                        <td class="fin">
                            <a href="inscription.php">
                                <input type="button" name="initialiser" id="initialiser" value="Initialiser">
                            </a>
                        </td>
                    </tr>
                </table>
                
            </form>
        </div>
<?php include "../model/footer.php"; ?>