<?php
    session_start();
?>
<?php
	$_SESSION["page"]="billet.php?idt=".$_GET['idt'];
    require_once("Controller/controller.php");
    $unControleur = new Controller ("localhost", "hyperloop", "root", ""); 
    if (isset($_POST['seConnecter'])) {
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];
        $resultat = $unControleur->verifConnexion($login, $mdp);
        if (isset($resultat['nom'])) {
                $_SESSION["iduser"] = $resultat['iduser'];
                $_SESSION["login"] = $resultat['login'];
                $_SESSION["mdp"] = $resultat['mdp'];
                $_SESSION["nom"] = $resultat['nom'];
                $_SESSION["prenom"] = $resultat['prenom'];
                $_SESSION["genre"] = $resultat['genre'];
                $_SESSION["telephone"] = $resultat['numero'];
                $_SESSION["naissance"] = $resultat['naissance'];
        }else{
			echo "<center><div class='alert alert-danger' role='alert'><strong>Erreur de connexion</strong></div></center>";
		}
    }
?>
<!DOCTYPE html>
<html>
    <?php require_once("View/header.php"); ?>
    <section id="reservation">
        <div class="blue-divider"></div>
        <div class="heading">
            <h2>Billet</h2>
        </div>
        <div class="container">
            <table class='table table-bordered table-striped' id='myTable'>
                <tr><td>N° Train</td><td>Type</td><td>Gare de départ</td></td><td>Heure de départ</td><td>Gare d'arrivée</td></td></rd><td>Heure d'arrivée</td><td>Date</td><td>Place libre</td><td>Prix par personne</td></tr>
                <?php
					$prix=0;
                    foreach ($_SESSION["res"] as $unResultat) {
                        if ($unResultat['id_train']==$_GET['idt']) {
                            echo "<tr><td>".$unResultat[0]."</td>
                            <td>".$unResultat[1]."</td>
                            <td>".$unResultat[2]."</td>
                            <td>".$unResultat[3]."</td>
                            <td>".$unResultat[4]."</td>
                            <td>".$unResultat[5]."</td>
                            <td>".$unResultat[6]."</td>
                            <td>".$unResultat[7]."</td>
                            <td>".$unResultat[8]."</td>
                            </tr>";
							$prix=$unResultat[8];
							$date=date('d/m/Y');
							$_SESSION['train']=$unResultat[0];//Sauvegarde train pour ecriture reservation
							if (empty($unResultat[7])) {
								$_SESSION["nbplacelibre"]="";
							}else{
								$_SESSION["nbplacelibre"]=$unResultat[7] - $_SESSION["nb_personne"];//Mise à jour place libre si non null (train sans reservation)
							}
							$_SESSION['billet']="Le ".$date." : ".$unResultat[0]."/".$unResultat[1]."/".$unResultat[2]."/".$unResultat[3]."/".$unResultat[4]."/".$unResultat[5]."/".$unResultat[6]."/";
                            // <td><a href='payer.php'>Je choisis cet aller</td></tr>";
						}
					}
					echo "</table>";
					echo "</br>";
					echo "</br>";
					echo "<div class='heading'><h2>Nom des voyageurs</h2></div>";
					echo "<form method='post' action=''>";
 					for ($i=1; $i <= $_SESSION['nb_personne'];$i++) {
						echo "<div class='form-row'>";
						echo "<div class='col'>";
						echo "<input type='text'  name='nomV".$i."' placeholder='Nom voyageur n° ".$i."' class='form-control'>";
						echo "</div>";						
						echo "<div class='col'>";
						echo "<input type='number'  name='reducV".$i."' placeholder='Réduction en % du voyageur n° ".$i."' class='form-control'>";
						echo "</div>";						
						echo "</div>";						
					}
					echo "</br><center><table><tr><td><button type='reset' name='annuler' value='annuler' class='btn btn-danger'>Annuler</button></td>";
					echo "<td><button type='submit' name='valider' value='valider' class='btn btn-info'>Valider</button></td></tr></table></center>";
					echo "</form>";						
                    if (isset($_POST['valider'])) {
						$_SESSION['prixTotal']=0;
						$empty=$_SESSION['nb_personne'];//verif si nom renseigné
						$sup99=0;//verif si % < 100
						$voyageur="Voyageur(s) : ";
						for ($i=1; $i <= $_SESSION['nb_personne'];$i++) {//calcul du prix total
                            if(empty ($_POST['reducV'.$i])) { $_POST['reducV'.$i]=0; }
							$_SESSION['prixTotal']=$_SESSION['prixTotal'] + $prix * (100 - $_POST['reducV'.$i])/100;
							if (!empty($_POST['nomV'.$i])) {$empty=$empty -1;}
							if (empty($_POST['reducV'.$i])) {
								$_POST['reducV'.$i]=0;
								$reduc=" ";
							}else {
								$reduc=" (-".$_POST['reducV'.$i]."%) ";
							}								
							if ($_POST['reducV'.$i] < 0 || $_POST['reducV'.$i] > 99) {
								$sup99=$sup99 + 1;
							}
							$voyageur=$voyageur."n° ".$i.": ".$_POST['nomV'.$i].$reduc;
						}
						if ($empty == 0 && $sup99 == 0) {
							//header('Location: payer.php');
							//var_dump($_SESSION['billet']);
							$_SESSION['billet']=$_SESSION['billet'].$_SESSION['prixTotal']." €/".$voyageur;
							echo "</br><div class='heading'><font color='green'>".$voyageur."</font></div>";
							if (isset($_SESSION["login"]) && $_SESSION["login"] !="") {
								echo "<div class='heading'><font color='green'><h3>Montal total à payer : ".$_SESSION['prixTotal']." €</br><a href='payer.php'>Cliquer ici pour payer</a></h3></font></div>";
							}else{
								echo "<center><div class='alert alert-danger' role='alert'><strong>Vous devez vous connecter pour continuer</strong></div></center>";
							}
							
						}else {
							echo "</br>"; 
							if ($empty > 0) {echo "<center><div class='alert alert-danger' role='alert'><strong>Renseigner tous les noms des voyageurs</strong></div></center>";}
							if ($sup99 > 0) {echo "<div class='alert alert-danger' role='alert'><strong>Le % de réduction doit être compris entre 0 et 99</strong></div>";}
						}
					}
						//faire écriture table voyageur et reservation ************************
						
						
//                                if (isset($_SESSION['login']) and !empty($_SESSION['login'])) { 
//                                <td><a href='payer.php'></td></tr>";
//                            } else {
//                                 <td><a class='nav-link' data-toggle='modal' data-target='#login'>Connexion</a></td></tr>";
//                            }
                            
//                            <td> <a href='payer.php'>Payer</td>
//                            </tr>";                         
                 ?>
        </div>
    </section>
    <?php require_once("View/login.php");?>
    <?php require_once("View/footer.php"); ?>
</body>
</html>