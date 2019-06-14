<?php
    session_start();
?>
<?php
	$_SESSION["page"]="reservation.php";//Pour retour inscription
    require_once("Controller/controller.php");
    $unControleur = new Controller ("localhost", "hyperloop", "root", ""); // Enleve le deuxieme root ! sur Windows ! Partout 
    if (isset($_POST['seConnecter'])) {
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];
        $resultat = $unControleur->verifConnexion($login, $mdp);
        // var_dump($resultat);
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
    <?php require_once("View/header.php");?>
    <section id="reservation">
        <div class="blue-divider"></div>
        <div class="heading">
             <?php echo "<h2>Trains Disponibles pour ".$_SESSION["nb_personne"]." voyageur(s)</h2>"; ?>
        </div>
        <div class="container">
            <table class='table table-bordered table-striped' id='myTable'>
                <tr><td>N° Train</td><td>Type</td><td>Gare de départ</td></td><td>Heure de départ</td><td>Gare d'arrivée</td></td></rd><td>Heure d'arrivée</td><td>Date</td><td>Place libre</td><td>Prix en €</td>
                <?php
                    foreach ($_SESSION["res"] as $unResultat) {
						$prix=$unResultat['prix'] * $_SESSION["nb_personne"]; //Calcul du prix total (sans réduction)
                        echo "<tr><td>".$unResultat['id_train']."</td>
                        <td>".$unResultat['type']."</td>
                        <td>".$unResultat['gare_depart']."</td>
                        <td>".$unResultat['heure_depart']."</td>
                        <td>".$unResultat['gare_arrivee']."</td>
                        <td>".$unResultat['heure_arrivee']."</td>
                        <td>".$unResultat['date']."</td>
                        <td>".$unResultat['place_libre']."</td>";
						if (empty($unResultat['place_libre']) || ($_SESSION["nb_personne"] <= $unResultat['place_libre'])) {
							echo "<td><a href='billet.php?idt=".$unResultat['id_train']."'>".$prix."</td></tr>";
						}else {
							echo "<td>complet</td></tr>";
						}
                    }
                ?>
            </table>
        </div>
    </section>
    <?php require_once("View/login.php"); ?>
    <?php require_once("View/footer.php"); ?>
    </body>
</html>