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
				$_SESSION['Champ0']="type";
				$_SESSION['delete']="ID";
				if (isset($_POST['supprimer'])) {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champx']="";
					$unControleur->delete($_SESSION['Champ0'],'id_ty',$_POST["idsupp"]);
				}elseif (isset($_POST['valider']) || isset($_POST['modifier'])) {
					$_SESSION['Champ1'] = $_POST['id_ty'];
					$_SESSION['Champ2'] = $_POST['lib_ty'];
					if ( empty($_POST["lib_ty"])) {
	                     echo "<div class='alert alert-danger' role='alert'>";
                         echo "<strong>"; 
                         echo "Validez tous les champs obligatoires (:)";
                         echo "</strong>";
                         echo "</div>";
					} else {
						if (isset($_POST['valider'])) {//verif si pas de doublon
							$res = $unControleur->selectOne($_SESSION['Champ0'],'id_ty',$_SESSION['Champ1']);
							if ($res) {//Doublon
								echo "<div class='alert alert-danger' role='alert'>";
								echo "<strong>"; 
								echo $_SESSION['Champ1']." déjà crée";
								echo "</strong>";
								echo "</div>";							
							}else {//Création OK
								$_SESSION['Champ1']="";
								$_SESSION['Champ2']="";
								$_SESSION['Champx']="";
								$unControleur->insertTab($_SESSION['Champ0'],$_POST);
							}
						}else {//Modification : verif si existe
							$res = $unControleur->selectOne($_SESSION['Champ0'],'id_ty',$_SESSION['Champ1']);
							if (!$res) {//Id inexistant
								echo "<div class='alert alert-danger' role='alert'>";
								echo "<strong>"; 
								echo "Veuillez renseigner un identifiant existant";
								echo "</strong>";
								echo "</div>";							
							}else {//Modification OK
								$_SESSION['Champ1']="";
								$_SESSION['Champ2']="";
								$_SESSION['Champx']="";
								$unControleur->updateTab($_SESSION['Champ0'],1,$_POST);
							}
						}
					}	
				}elseif (isset ($_GET['idt'])) {
					$res = $unControleur->selectOne($_SESSION['Champ0'],'id_ty',$_GET['idt']);
					$_SESSION['Champ1'] = $res['id_ty'];
					$_SESSION['Champ2'] = $res['lib_ty'];
					$_SESSION['Champx'] = $_GET['idt'];
				}else {
					$_SESSION['Champ1']="";
					$_SESSION['Champ2']="";
					$_SESSION['Champx']="";
				}
				require_once("View/vue_maj_type.php");
				require_once("View/vue_delete.php");
				$resultats = $unControleur->selectAll($_SESSION['Champ0']); 		
				require_once("View/vue_select_type.php");
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