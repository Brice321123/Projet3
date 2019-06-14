<?php 
	session_start();
?>
		<center>
			<?php
			//var_dump($_POST);
			if (isset($_SESSION["iduser"]) && $_SESSION["iduser"] == 1) {
				require_once("Controller/controller.php");
				// instanciation de la classe Controleur
				$unControleur = new Controller ("localhost", $_SESSION['bdH'], $_SESSION['logH'],$_SESSION['mdpH']);
				$_SESSION['Champ0']="utilisateur";
				$_SESSION['delete']="ID";
				if (isset($_POST['supprimer'])) {
						$_SESSION['Champ1']="";
						$_SESSION['Champ2']="";
						$_SESSION['Champ3']="";
						$_SESSION['Champ4']="";
						$_SESSION['Champ5']="";
						$_SESSION['Champ6']="";
						$_SESSION['Champ7']="";
						$_SESSION['Champ8']="";
						$_SESSION['Champx']="";
					if ($_POST["idsupp"] == 1) {
						echo "<font color='red'>Impossible de supprimer l'Administrateur</font>";	
					}else $unControleur->delete($_SESSION['Champ0'],'iduser',$_POST["idsupp"]);
				}elseif (isset($_POST['valider']) || isset($_POST['modifier'])) {//Sauvegarde champs
						$_SESSION['Champ1'] = $_POST['iduser'];
						$_SESSION['Champ2'] = $_POST['login'];
						$_SESSION['Champ3'] = $_POST['mdp'];
						$_SESSION['Champ4'] = $_POST['nom'];
						$_SESSION['Champ5'] = $_POST['prenom'];
						$_SESSION['Champ6'] = $_POST['genre'];
						$_SESSION['Champ7'] = $_POST['numero'];
						$_SESSION['Champ8'] = $_POST['naissance'];
					if ( empty($_POST['login']) || empty($_POST['mdp']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['genre']) || empty($_POST['numero']) || empty($_POST['naissance'])) {
	                     echo "<div class='alert alert-danger' role='alert'>";
                         echo "<strong>"; 
                         echo "Validez tous les champs obligatoires (:)";
                         echo "</strong>";
                         echo "</div>";
					} else {
						if (isset($_POST['valider'])) {//verif si pas de doublon
							$res1 = $unControleur->selectOne($_SESSION['Champ0'],'iduser',$_SESSION['Champ1']);
							$res2 = $unControleur->selectOne($_SESSION['Champ0'],'login',$_SESSION['Champ2']);
							if ($res1 || $res2) {//Doublon
								echo "<div class='alert alert-danger' role='alert'>";
								echo "<strong>"; 
								echo "Identifiant ".$_SESSION['Champ1']." ou ".$_SESSION['Champ2']." déjà crée";
								echo "</strong>";
								echo "</div>";							
							}else {//Création OK
								$_SESSION['Champ1']="";
								$_SESSION['Champ2']="";
								$_SESSION['Champ3']="";
								$_SESSION['Champ4']="";
								$_SESSION['Champ5']="";
								$_SESSION['Champ6']="";
								$_SESSION['Champ7']="";
								$_SESSION['Champ8']="";
								$_SESSION['Champx']="";
								$unControleur->insertTab($_SESSION['Champ0'],$_POST);
							}
						}else {//Modification : verif si existe
							$res = $unControleur->selectOne($_SESSION['Champ0'],'iduser',$_SESSION['Champ1']);
							if (!$res) {//Id inexistant
								echo "<div class='alert alert-danger' role='alert'>";
								echo "<strong>"; 
								echo "Veuillez renseigner un identifiant existant";
								echo "</strong>";
								echo "</div>";							
							}else {//Modification OK
								$_SESSION['Champ1']="";
								$_SESSION['Champ2']="";
								$_SESSION['Champ3']="";
								$_SESSION['Champ4']="";
								$_SESSION['Champ5']="";
								$_SESSION['Champ6']="";
								$_SESSION['Champ7']="";
								$_SESSION['Champ8']="";
								$_SESSION['Champx']="";
								$unControleur->updateTab($_SESSION['Champ0'],1,$_POST);
							}
						}
					}
				}elseif (isset ($_GET['idt'])) {
					$res = $unControleur->selectOne($_SESSION['Champ0'],'iduser',$_GET['idt']);
					$_SESSION['Champ1'] = $res['iduser'];
					$_SESSION['Champ2'] = $res['login'];
					$_SESSION['Champ3'] = $res['mdp'];
					$_SESSION['Champ4'] = $res['nom'];
					$_SESSION['Champ5'] = $res['prenom'];
					$_SESSION['Champ6'] = $res['genre'];
					$_SESSION['Champ7'] = $res['numero'];
					$_SESSION['Champ8'] = $res['naissance'];
					$_SESSION['Champx'] = $_GET['idt'];
				}else {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champ3']="";
					$_SESSION['Champ4']="";
					$_SESSION['Champ5']="";
					$_SESSION['Champ6']="";
					$_SESSION['Champ7']="";
					$_SESSION['Champ8']="";
					$_SESSION['Champx']="";
				}
				require_once("View/vue_maj_user.php");
				require_once("View/vue_delete.php");
				$resultats = $unControleur->selectAll($_SESSION['Champ0']); 		
				require_once("View/vue_select_user.php");
				} else {
				echo "<a href='majdb.php'>Veuillez vous connecter en mode Administrateur !</a>";
			}
			?>
		</center>
<!--
M injection extraction interaction de la bdd 
V visualition des donnes
C controller des donnees 
-->
