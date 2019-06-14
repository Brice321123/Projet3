<?php
session_start();
?>
<?php
	$_SESSION["page"]="payer.php";//Pour retour inscription
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
	if (isset($_POST['payer'])) {
		//Ecriture sur table billet
		$tabb[0]="";//Identifiant null pour auto_increment
		$tabb[1]=$_SESSION["iduser"];
		$tabb[2]=$_SESSION['billet'];
		$tabb[3]="";//Champ submit
		$unControleur->insertTab('billet',$tabb);
		
		//Ecriture sur table reservation
		$tabr[0]="";//Identifiant null pour auto_increment
		$tabr[1]=$_SESSION["nb_personne"];
		$tabr[2]="0";//Aller simple
		$tabr[3]=$_SESSION["date_ca"];//date reservation
		$tabr[4]=$_SESSION["train"];
		$tabr[5]="";//Champ null
		$tabr[6]="";//Champ null
		$tabr[7]="";//Champ submit
		$unControleur->insertTab('reservation',$tabr);

		//Modification place libre sur table circuler si non vide
		if (!empty($_SESSION["nbplacelibre"])) {
			$tabc['date_ca']=$_SESSION["date_ca"];//date reservation
			$tabc['id_tr']=$_SESSION["train"];
			$tabc['nbplacelibre']=$_SESSION["nbplacelibre"];
			$tabc['modifier']="";//Champ submit
			$unControleur->updateTab('circuler',2,$tabc);
		}
		
		//Ecriture sur table voyageur
		//A faire plus tard 
		
		//Retour accueil avec message paiement accepté
        header("Location: index.php?id=2");
	}
?>
 <?php require_once("View/header.php")?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    <section id="payement">
    <div class="blue-divider"></div>
        <div class="heading">
            <h2>Payer</h2>
        </div>
		<?php
			echo "<div class='heading'><font color='green'><h3>Montal total à payer : ".$_SESSION['prixTotal']." €</h3></font></div>";
		?>
        <div class="container">
            <aside class="col-sm-12">
                <article class="card">
                    <div class="card-body p-5">
                        <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                <i class="fa fa-credit-card"></i>  Carte de crédit</a></li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
                                <i class="fab fa-paypal"></i>  Paypal</a></li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                                <i class="fa fa-university"></i>  Virement</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                <form role="form"  method="post">
                                <div class="form-group">
                                    <label for="username">Nom Prénom (sur la carte)</label>
                                    <input type="text" class="form-control" name="username" placeholder="Nom Prénom" required="">
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Numéro de carte</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cardNumber" placeholder="Numéro">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-muted">
                                                <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>   
                                                <i class="fab fa-cc-mastercard"></i> 
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Expiration</span> </label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="MM" name="">
                                                <input type="number" class="form-control" placeholder="AA" name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                            <input type="number" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
									<button type="submit" name="payer" class="subscribe btn btn-primary btn-block">Payer</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-tab-paypal">
                                <p>Paypal est le moyen le plus simple de payer en ligne</p>
                               
                                <p>
                                    <button type="button" class="btn btn-primary"> <i class="fab fa-paypal"></i> Se connecter à Paypal</button>
                                </p>
                                <p><strong>Note:</strong> Vos données sont protégés. </p>
                            </div>
                            <div class="tab-pane fade" id="nav-tab-bank">
                                <p>Détails du compte en banque : </p>
                                <dl class="param">
                                  <dt>BANQUE: </dt>
                                  <dd> BOURSORAMA BANQUE</dd>
                                </dl>
                                <dl class="param">
                                  <dt>Numéro de compte: </dt>
                                  <dd> 12345678912345</dd>
                                </dl>
                                <dl class="param">
                                  <dt>IBAN: </dt>
                                  <dd> 123456789</dd>
                                </dl>
                                <p><strong>Note:</strong> Dés réception du virement votre billet sera validé.</p>
                            </div> 
                        </div>
                    </div> 
                </article>
            </aside>
        </div>
    </section>
   <?php require_once("View/login.php");?>
   <?php require_once("View/footer.php")?>
</body>
</html>