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
				$_SESSION['Champ0']="s_arreter";
				$_SESSION['delete']="GGGTTTTTTTTTT (G=id gare sur 3 car. T=id train sur 10 car. max)";
				if (isset($_POST['supprimer'])) {
						$_SESSION['Champ1']="";
						$_SESSION['Champ2']="";
						$_SESSION['Champ3']="";
						$_SESSION['Champ4']="";
						$_SESSION['Champ5']="";
						$_SESSION['Champx']="";
						$id1=substr($_POST["idsupp"],0,3); //gare
						$id2=substr($_POST["idsupp"],3,10); //train
						$unControleur->deleteTwo($_SESSION['Champ0'],'id_ga',$id1,'id_tr',$id2);
				}elseif (isset($_POST['valider']) || isset($_POST['modifier'])) {//Sauvegarde champs
						$_SESSION['Champ1'] = $_POST['id_ga'];
						$_SESSION['Champ2'] = $_POST['id_tr'];
						$_SESSION['Champ3'] = $_POST['arrivee_ar'];
						$_SESSION['Champ4'] = $_POST['depart_ar'];
						$_SESSION['Champ5'] = $_POST['distance_ar'];
					if  (empty($_POST['id_ga']) || empty($_POST['id_tr']) || empty($_POST['arrivee_ar']) || empty($_POST['depart_ar']) || empty($_POST['distance_ar'])) {
	                     echo "<div class='alert alert-danger' role='alert'>";
                         echo "<strong>"; 
                         echo "Validez tous les champs obligatoires (:)";
                         echo "</strong>";
                         echo "</div>";
					} else {
						if (isset($_POST['valider'])) {//verif si pas de doublon
							$res = $unControleur->selectTwo($_SESSION['Champ0'],'id_ga',$_SESSION['Champ1'],'id_tr',$_SESSION['Champ2']);
								if ($res) {//Doublon
									echo "<div class='alert alert-danger' role='alert'>";
									echo "<strong>"; 
									echo $_SESSION['Champ1']." ".$_SESSION['Champ2']." déjà crée";
									echo "</strong>";
									echo "</div>";							
								}else {//Création OK
									$_SESSION['Champ1']="";
									$_SESSION['Champ2']="";
									$_SESSION['Champ3']="";
									$_SESSION['Champ4']="";
									$_SESSION['Champ5']="";
									$_SESSION['Champx']="";
									$unControleur->insertTab($_SESSION['Champ0'],$_POST);
								}
							}else {
								$res = $unControleur->selectTwo($_SESSION['Champ0'],'id_ga',$_SESSION['Champ1'],'id_tr',$_SESSION['Champ2']);
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
									$_SESSION['Champx']="";
									$unControleur->updateTab($_SESSION['Champ0'],2,$_POST);
								}	
							}
					}
				}elseif (isset ($_GET['idt1'])) {
					$res = $unControleur->selectTwo($_SESSION['Champ0'],'id_ga',$_GET['idt1'],'id_tr',$_GET['idt2']);
					$_SESSION['Champ1'] = $res['id_ga'];
					$_SESSION['Champ2'] = $res['id_tr'];
					$_SESSION['Champ3'] = $res['arrivee_ar'];
					$_SESSION['Champ4'] = $res['depart_ar'];
					$_SESSION['Champ5'] = $res['distance_ar'];
					$_SESSION['Champx'] = str_pad($_GET['idt1'],3,'0', STR_PAD_LEFT).$_GET['idt2'];
				}else {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champ3']="";
					$_SESSION['Champ4']="";
					$_SESSION['Champ5']="";
					$_SESSION['Champx']="";
				}
				require_once("View/vue_maj_arret.php");
				require_once("View/vue_delete.php");
				$resultats = $unControleur->selectAll($_SESSION['Champ0']); 		
				require_once("View/vue_select_arret.php");
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
