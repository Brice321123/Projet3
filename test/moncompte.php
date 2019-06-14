<?php
  session_start();
?>
<?php
  require_once("Controller/controller.php");
  $unControleur = new Controller ("localhost", "hyperloop", "root", "");

  if (isset($_POST['seConnecter'])) {
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];
        $resultat = $unControleur->verifConnexion($login, $mdp);
        //var_dump($resultat);
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
	<section id="inscription">
	    <div class="blue-divider"></div>
	        <div class="heading">
	            <h2>MON COMPTE</h2>
	        </div>
		<div class="container">
	        <div class="row">
	            <div class="col-12">
	                <div class="card">

	                    <div class="card-body">
	                        <div class="card-title mb-4">
	                            <div class="d-flex justify-content-start">
	                                <div class="image-container">
	                                    <img <?php 
                                                if ($_SESSION['genre'] == "MR" ) {
                                                        echo "src='images/monsieur.jpg'";
                                                    } else {
                                                        echo "src='images/madame.png'";
                                                    }
                                                  ?> id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
	                                    <div class="middle">
	                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change"/>
	                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
	                                    </div>
	                                </div>
	                                <div class="userData ml-3">
	                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><?php echo $_SESSION['prenom']." ". $_SESSION['nom']; ?></h2>
	                                </div>
	                                <div class="ml-auto">
	                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
	                                </div>
	                            </div>
	                        </div>

	                        <div class="row">
	                            <div class="col-12">
	                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
	                                    <li class="nav-item">
	                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" 
                                            aria-controls="basicInfo" aria-selected="true">Infos personnelles</a>
	                                    </li>
	                                    <li class="nav-item">
	                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" 
                                            aria-controls="connectedServices" aria-selected="false">Mes billets</a>
	                                    </li>
	                                </ul>
	                                <div class="tab-content ml-1" id="myTabContent">
	                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
	                                        

	                                        <div class="row">
	                                            <div class="col-sm-3 col-md-2 col-5">
	                                                <label style="font-weight:bold;">Prénom Nom</label>
	                                            </div>
	                                            <div class="col-md-8 col-6">
	                                                <?php echo $_SESSION['prenom']." ". $_SESSION['nom']; ?>
	                                            </div>
	                                        </div>
	                                        <hr />

	                                        <div class="row">
	                                            <div class="col-sm-3 col-md-2 col-5">
	                                                <label style="font-weight:bold;">Date de naissance</label>
	                                            </div>
	                                            <div class="col-md-8 col-6">
	                                                <?php echo $_SESSION['naissance']; ?>
	                                            </div>
	                                        </div>
	                                        <hr />
	                                        
	                                        
	                                        <div class="row">
	                                            <div class="col-sm-3 col-md-2 col-5">
	                                                <label style="font-weight:bold;">Téléphone</label>
	                                            </div>
	                                            <div class="col-md-8 col-6">
	                                                <?php echo $_SESSION['telephone']; ?>
	                                            </div>
	                                        </div>
	                                        <hr />
	                                        <div class="row">
	                                            <div class="col-sm-3 col-md-2 col-5">
	                                                <label style="font-weight:bold;">Email</label>
	                                            </div>
	                                            <div class="col-md-8 col-6">
	                                                <?php echo $_SESSION['login']; ?>
	                                            </div>
	                                        </div>
	                                        <hr />
	                                        <div class="row">
	                                            <div class="col-sm-3 col-md-2 col-5">
	                                                <label style="font-weight:bold;">Mot de passe</label>
	                                            </div>
	                                            <div class="col-md-8 col-6">
	                                                <?php echo $_SESSION['mdp']; ?>
	                                            </div>
	                                        </div>
	                                        <hr />

	                                    </div>
	                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
	                                        Liste de vos billets achetés :
											<?php 
												$resultats = $unControleur->selectAll('billet');
												$trouve=0;
												foreach ($resultats as $unResultat) {
													if ($unResultat['iduser'] == $_SESSION['iduser']) {
														$trouve=1;
														echo "</br>".$unResultat['texte_bi'];																							
													}
												}
												if ($trouve == 0) {//Billet non trouvé
													echo "</br>Aucun billet acheté";																							
												}						
											?>
										
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
    <?php require_once("View/footer.php");?>
</body>
</html>