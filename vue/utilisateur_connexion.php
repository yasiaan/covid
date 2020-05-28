<?php
session_start();

include "../model/connexion.php";

if(isset($_POST['connexion'])){
    if(isset($_POST['mot_de_passe']) && isset($_POST['email'])){
        $sql = "SELECT mot_de_passe, admin FROM utilisateur WHERE email='{$_POST['email']}'";
        $req = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($req);
        if( $result !== NULL){
            $hashed = hash('md5', $_POST['mot_de_passe']);
            if($result['mot_de_passe'] == $hashed){
                $_SESSION['utilisateur'] = $result['admin'];
                if($result['admin'] == 1){
                    header("Location: index.php");
                    return;
                }else{
                    $sql_id = "SELECT id FROM etudiants WHERE email = '{$_POST['email']}'";
                    $req_id = mysqli_query($conn, $sql_id);
                    $result_id = mysqli_fetch_assoc($req_id);
                    $_SESSION['etudiant_id'] = $result_id['id'];
                    header("Location: profile.php?id=".$_SESSION['etudiant_id']);
                    return;
                }
            }else{
                $_SESSION['error'] = 'Mot de passe incorrect';
                header("Location: utilisateur_connexion.php");
                return;
            }
        }else{
            $_SESSION['error'] = 'Email incorrect';
            header("Location: utilisateur_connexion.php");
            return;
        }
    }
}

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
                echo '<h3>Connectez-vous</h3>';
            }
            ?>
            <form method="POST">
                <div class="connexion">
                    <label for="email">Email :</label>
                    <input type="text" placeholder="Votre email" name="email" id="email" size="26" required><br>
                
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" placeholder="Votre mot de passe" name="mot_de_passe" id="mot_de_passe" size="18" required><br>
                        
                    <input type="submit" name="connexion" value="Connexion" title="Connexion">
                
                    <p>Nouveau ? Insrivez-vous !
                    <a href="inscription.php"><input type="button" name="inscription" value="S'inscrire" title="S'inscrire"></a> 
                </div>
            </form>
        </div>
<?php include "../model/footer.php"; ?>
