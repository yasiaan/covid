<?php
include "../model/validation_confirmation.php";

include "../model/nav.php";

?>
        <div>
            <span>
                <h1 class="titre">INSEA - Inscription en ligne</h1><br><br>
            </span>
            <?php
            if(isset($_SESSION['error'])){
                echo '<h3 id="error">'.$_SESSION['error'].'</h3>';
                unset($_SESSION['error']);
            }else{
                echo '<h3>veuillez vérifier votre adresse e-mail</h3>';
            }
            ?>
            <form method="POST">
                <div class="connexion">
                    <label for="code_confirmation">Code de confirmation :</label>
                    <input type="text" placeholder="Votre code de confirmation" name="code_confirmation" id="code_confirmation" size="26" required><br>
                
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" placeholder="Votre mot de passe" name="mot_de_passe" id="mot_de_passe" size="24" required><br>
                    
                    <label for="mot_de_passe2">Confirmez votre mot de passe :</label>
                    <input type="password" placeholder="Votre mot de passe" name="mot_de_passe2" id="mot_de_passe2" size="18" required><br>
                        
                    <input type="submit" name="confirmer" value="Confirmer" title="Confirmer">
                
                </div>
            </form>
        </div>
<?php include "../model/footer.php"; ?>