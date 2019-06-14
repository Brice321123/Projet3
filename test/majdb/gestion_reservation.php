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
				$_SESSION['Champ0']="reservation";
				$_SESSION['delete']="ID";
				if (isset($_POST['supprimer'])) {
						$_SESSION['Champ1']="";
						$_SESSION['Champ2']="";
						$_SESSION['Champ3']="";
						$_SESSION['Champ4']="";
						$_SESSION['Champ5']="";
						$_SESSION['Champ6']="";
						$_SESSION['Champ7']="";
						$_SESSION['Champx']="";
						$unControleur->delete($_SESSION['Champ0'],'id_re',$_POST["idsupp"]);
				}elseif (isset($_POST['valider']) || isset($_POST['modifier'])) {//Sauvegarde champs
						$_SESSION['Champ1'] = $_POST['id_re'];
						$_SESSION['Champ2'] = $_POST['nbvoyageur_re'];
						$_SESSION['Champ3'] = $_POST['allerretour_re'];
						$_SESSION['Champ4'] = $_POST['date_ca'];
						$_SESSION['Champ5'] = $_POST['id_tr'];
						$_SESSION['Champ6'] = $_POST['id_tr_Train'];
						$_SESSION['Champ7'] = $_POST['date_ca_Calendrier'];
					if ( empty($_POST['nbvoyageur_re']) || empty($_POST['date_ca']) || empty($_POST['id_tr']) 
							|| (!empty($_POST['id_tr_Train']) && empty($_POST['date_ca_Calendrier'])) || (empty($_POST['id_tr_Train']) && !empty($_POST['date_ca_Calendrier']))
							|| (($_POST['allerretour_re'] == '0') && !empty($_POST['id_tr_Train'])) || (($_POST['allerretour_re'] == '1') && empty($_POST['id_tr_Train']))) {
	                     echo "<div class='alert alert-danger' role='alert'>";
                         echo "<strong>"; 
                         echo "Validez tous les champs obligatoires (:) ou conditionnel (=)";
                         echo "</strong>";
                         echo "</div>";
					} else {
						if (isset($_POST['valider'])) {//verif si pas de doublon
							$res = $unControleur->selectOne($_SESSION['Champ0'],'id_re',$_SESSION['Champ1']);
							if ($res) {//Doublon
								echo "<div class='alert alert-danger' role='alert'>";
								echo "<strong>"; 
								echo $_SESSION['Champ1']." déjà crée";
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
								$_SESSION['Champx']="";
								$unControleur->insertTab($_SESSION['Champ0'],$_POST);									
							}
						}else {
							$res = $unControleur->selectOne($_SESSION['Champ0'],'id_re',$_SESSION['Champ1']);
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
								$_SESSION['Champx']="";
								$unControleur->updateTab($_SESSION['Champ0'],1,$_POST);
							}	
						}
					}
				}elseif (isset ($_GET['idt'])) {
					$res = $unControleur->selectOne($_SESSION['Champ0'],'id_re',$_GET['idt']);
					$_SESSION['Champ1'] = $res['id_re'];
					$_SESSION['Champ2'] = $res['nbvoyageur_re'];
					$_SESSION['Champ3'] = $res['allerretour_re'];
					$_SESSION['Champ4'] = $res['date_ca'];
					$_SESSION['Champ5'] = $res['id_tr'];
					$_SESSION['Champ6'] = $res['id_tr_Train'];
					$_SESSION['Champ7'] = $res['date_ca_Calendrier'];
					$_SESSION['Champx'] = $_GET['idt'];
				}else {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champ3']="";
					$_SESSION['Champ4']="";
					$_SESSION['Champ5']="";
					$_SESSION['Champ6']="";
					$_SESSION['Champ7']="";
					$_SESSION['Champx']="";
				}
				require_once("View/vue_maj_reservation.php");
				require_once("View/vue_delete.php");
				$resultats = $unControleur->selectAll($_SESSION['Champ0']); 		
				require_once("View/vue_select_reservation.php");
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
