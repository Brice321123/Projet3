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
				$_SESSION['Champ0']="billet";
				$_SESSION['delete']="ID";
				if (isset($_POST['supprimer'])) {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champ3']="";
					$_SESSION['Champx']="";
					$unControleur->delete($_SESSION['Champ0'],'id_bi',$_POST["idsupp"]);
				}elseif (isset($_POST['valider']) || isset($_POST['modifier'])) {
					$_SESSION['Champ1'] = $_POST['id_bi'];
					$_SESSION['Champ2'] = $_POST['iduser'];
					$_SESSION['Champ3'] = $_POST['texte_bi'];
					if (empty($_POST["iduser"])) {
	                     echo "<div class='alert alert-danger' role='alert'>";
                         echo "<strong>"; 
                         echo "Validez tous les champs obligatoires (:)";
                         echo "</strong>";
                         echo "</div>";
					} else {
						if (isset($_POST['valider'])) {//verif si pas de doublon
							$res = $unControleur->selectOne($_SESSION['Champ0'],'id_bi',$_SESSION['Champ1']);
							if ($res) {//Doublon
								echo "<div class='alert alert-danger' role='alert'>";
								echo "<strong>"; 
								echo "Identifiant ".$_SESSION['Champ1']." déjà crée";
								echo "</strong>";
								echo "</div>";							
							}else {//Création OK
								$_SESSION['Champ1']="";
								$_SESSION['Champ2']="";
								$_SESSION['Champ3']="";
								$_SESSION['Champx']="";
								$unControleur->insertTab($_SESSION['Champ0'],$_POST);
							}
						}else {//Modification : verif si existe
							$res = $unControleur->selectOne($_SESSION['Champ0'],'id_bi',$_SESSION['Champ1']);
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
								$_SESSION['Champx']="";
								$unControleur->updateTab($_SESSION['Champ0'],1,$_POST);
							}
						}
					}
				}elseif (isset ($_GET['idt'])) {
					$res = $unControleur->selectOne($_SESSION['Champ0'],'id_bi',$_GET['idt']);
					$_SESSION['Champ1'] = $res['id_bi'];
					$_SESSION['Champ2'] = $res['iduser'];
					$_SESSION['Champ3'] = $res['texte_bi'];
					$_SESSION['Champx'] = $_GET['idt'];
				}else {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champ3']="";
					$_SESSION['Champx']="";
				}
				require_once("View/vue_maj_billet.php");
				require_once("View/vue_delete.php");
				// appel de la methode du controleur
				$resultats = $unControleur->selectAll($_SESSION['Champ0']); 		
				require_once("View/vue_select_billet.php");
				} else {
				echo "<a href='majdb.php'> Veuillez vous connecter en mode Administrateur ! </a>";
			}
			?>
		</center>
<!--
M injection extraction interaction de la bdd 
V visualition des donnes
C controller des donnees 
-->
