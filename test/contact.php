<?php
session_start();
?>
<?php
	$_SESSION["page"]="contact.php";//Pour retour inscription
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
    <?php require_once("View/header.php")?>
    <section id="contact">
       <div class="container">
            <div class="white-divider"></div>
            <div class="heading">
                <h2>CONTACT</h2>
            </div>
           <div class="row">
               <div class="col-lg-12">
                    <form id="contact-form" method="post" action="" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom <span class="blue">*</span></label>
                                <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Votre prénom">
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Nom <span class="blue">*</span></label>
                                <input id="name" type="text" name="name" class="form-control" placeholder="Votre Nom">
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email <span class="blue">*</span></label>
                                <input id="email" type="text" name="email" class="form-control" placeholder="Votre Email">
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input id="phone" type="tel" name="phone" class="form-control" placeholder="Votre Téléphone">
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="message">Message <span class="blue">*</span></label>
                                <textarea id="message" name="message" class="form-control" placeholder="Votre Message" rows="4"></textarea>
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="button1" value="Envoyer">
                            </div>    
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </section>
    <?php require_once("View/login.php"); ?>
    <?php require_once("View/footer.php")?> 
    </body>
</html>