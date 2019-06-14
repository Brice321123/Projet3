<?php 
	session_start();
	require_once("Controller/controller.php");
	// instanciation de la classe Controleur
	$_SESSION['bdH']="hyperloop";
	$_SESSION['logH']="root";
	$_SESSION['mdpH']="";
	$unControleur = new Controller ("localhost", $_SESSION['bdH'], $_SESSION['logH'],$_SESSION['mdpH']);
			
	require_once("View/vueConnexion.php");
				if (isset($_POST['seConnecter'])) {
					$login = $_POST["login"];
					$mdp = $_POST["mdp"];
					$resultat = $unControleur->verifConnexion($login, $mdp);
//					var_dump($resultat);
					if (isset($resultat['nom'])) {
						// Création d'une session
						
						$_SESSION["iduser"] = $resultat['iduser'];
						//$_SESSION["login"] = $resultat['login'];
						//$_SESSION["nom"] = $resultat['nom'];
						//$_SESSION["prenom"] = $resultat['prenom'];
						header("Location: menu_site.php?page=1");
					} else {
						echo "<font color='red'>Veuillez vérifier vos identifiants</font>";
					}
				}
			?>
		</center>
	</body>
</html>