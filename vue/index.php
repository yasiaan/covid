<?php
include "../model/donnees_index.php";

include "../model/nav.php";
?>
        <div style="margin-left:8%;">
            <h1 class="titre">Les inscrits à l'INSEA</h1><br>
            <span>
                <a href="../model/deconnexion.php" title="Déconnexion" class="btnInsAnn"><input type="button" value="Déconnexion" ></a>
            </span>
            <?php 
            if(isset($_SESSION['success'])){
                echo '<h3>'.$_SESSION['success'].'</h3>';
                unset($_SESSION['success']);
            }elseif(isset($_SESSION['error'])){
                echo '<h3 id="error">'.$_SESSION['error'].'</h3>';
                unset($_SESSION['error']);
            }
            table_etudiant(0);
            table_etudiant(1);
            ?>
                </tbody>
            </table>
        </div>
<?php include "../model/footer.php"; ?>