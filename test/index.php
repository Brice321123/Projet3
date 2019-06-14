<?php
    session_start();
?>
<?php
	$_SESSION["page"]="index.php";//Pour retour inscription
    require_once("Controller/controller.php");
    $unControleur = new Controller ("localhost", "hyperloop", "root", ""); 
    if (!isset($_SESSION['login']) || isset($_GET['id']) && $_GET['id']==1) {
       $_SESSION['login']="";
    }
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
    $champsErr = "";
    if(isset($_POST['Rechercher'])) {
        if (empty($_POST["gareA"]) || empty($_POST["gareD"]) || empty($_POST["dateA"])) {
            $champsErr = "Validez tous les champs obligatoires";
        }else if ($_POST['gareD'] == $_POST['gareA']) {
            $champsErr = "Vous avez sélectionné deux fois la même gare !";
        }else {
			if  (empty($_POST["heureA"])) {$_POST["heureA"]="00:00:00";} //Heure à 0 si vide
            $resultats = $unControleur->afficherReservation($_POST);
            if (!empty($resultats)) {
                $_SESSION["res"] = $resultats;
				$_SESSION["nb_personne"]=$_POST["nb_personne"];
				$_SESSION["date_ca"]=$_POST["dateA"];

				header("Location:reservation.php");
            }else {
                $champsErr = "Aucun train disponible à cette date !";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <?php require_once("View/header.php"); ?>
    <section id="reservation">
	<?php
		if (isset($_GET['id']) && $_GET['id']==2) {
			echo "<div class='heading'><font color='green'><h4>Votre paiement est accepté. Vous allez recevoir un email de confirmation</h4></font></div>";			
		}
	?>
        <div class="blue-divider"></div>
        <div class="heading">
            <h2>Réservation</h2>
        </div>
        <div class="container">
            <form method="post" action="">
                <div class="form-row">
                    <div class="col">
                        <label for="gare_D">Gare de départ :</label>                           
                        <select class="custom-select custom-select-lg mb-3"  id="gare_D" name="gareD">
                            <option value=""></option>
                            <?php 
                                $resultats = $unControleur->selectGare();
                                foreach ($resultats as $unResultat) {
                                    echo "<option value='".$unResultat['id_ga']."'>".$unResultat['nom_ga']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="gare_A">Gare d'arrivée :</label>  
                        <select class="custom-select custom-select-lg mb-3" id="gare_A" name="gareA">
                            <option value=""></option>
                            <?php 
                                foreach ($resultats as $unResultat) {
                                    echo "<option value='".$unResultat['id_ga']."'>".$unResultat['nom_ga']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="date_A">Date aller :</label>
                        <input type="date" id="date_A" name="dateA" class="form-control" min="2019-01-01">
                    </div>
                    <div class="col">
                        <label for="date_R">Date retour :</label>
                        <input type="date" id="date_R" name="dateR" class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="HeureA">Heure aller :</label>
                        <input type="time" id="HeureA" name="heureA" class="form-control">
                      </div>
                    <div class="col">
                        <label for="nb_personne">Nombre de personne :</label>
                         <select class="custom-select custom-select-lg mb-3" id="nb_personne" name="nb_personne">
                        <?php 
                            $i = 1;
                            while ($i <= 10) {
                                echo "<option value='".$i."'>".$i."</option>";
                                echo $i++;
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <br>
                <tr>
                    <center><td><button type="submit" name="Rechercher" value="Rechercher" class="btn btn-primary">Rechercher</button></td></center>
                    <br>
                    <?php
                        if(!empty($champsErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<center>";
                                echo "<strong>"; 
                                    echo $champsErr;
                                echo "</strong>";
                                echo "</center>";
                            echo "</div>";
                        }
                    ?>
                </tr>
            </form>
        </div>
    </section>
    <section id="place-train">
        <div class="white-divider"></div>
        <div class="heading">
            <h2>Les places a bords des trains</h2>
        </div>
        <center>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="standard">
                            <h5>Une place standard</h5>
                            <p>C'est l'essentiel pour voyager confortablement : les bagages cabine et bagages à main sont inclus.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="connectee">
                            <h5>Une place 100% connectée</h5>
                            <p>Recharger vos batteries pendant le voyage grâce à une prise électrique incluse !</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="detente">
                            <h5>Une place 100% détente</h5>
                            <p>Profitez de votre voyage en toute sérénité, en salle haute avec une prise électrique !</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banquette">
                            <h5>Une place banquette</h5>
                            <p>Même quand les trains sont très chargés, soyez assuré d'avoir une place sur les banquettes en interwagon.</p>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </section>
    <center>
        <section id="info">
            <div class="blue-divider"></div>
            <div class="heading">
                <h2>Services</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-center" style="width: 18rem;">
                            <img class="card-img-top" src="images/enfant.jpeg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Enfant</h5>
                                <p class="card-text">Pourquoi je dois acheter un billet pour mon bébé/enfant ?</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">En savoir plus</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center" style="width: 18rem;">
                            <img class="card-img-top" src="images/bagages.jpeg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Bagages</h5>
                                <p class="card-text">Quels sont les bagages inclus dans le prix de mon billet ?</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">En savoir plus</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center" style="width: 18rem;">
                            <img class="card-img-top" src="images/depart.jpeg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Départ</h5>
                                <p class="card-text">Pourquoi arriver 30 minutes avant le départ du train ?</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">En savoir plus</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center" style="width: 18rem;">
                            <img class="card-img-top" src="images/hyperloopbar.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Bar</h5>
                                <p class="card-text">Une fois à bord, profitez de nos produits Hyperloop.</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter3">En savoir plus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </center>
    <section id="ville">
        <div class="white-divider"></div>
        <div class="heading">
            <h2>Destination</h2>
        </div>
        <div id="accordion">
            <div class="container">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <strong>Villes Desservies</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            Paris LYON - Paris MONTPARNASSE - Marseille - Lyon Saint-Exupéry TGV - Bordeaux TGV <br> 
                            Nice TGV - Saintes - Avignon TGV - Valence
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <strong>Trajets avec l'Hyperloop</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            Paris - Marseille | Paris - Lyon | Paris - Lille | Paris - Nice <br>
                            Lyon - Marseille | Bordeaux - Marseille | Nice - Marseille  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="recommandations">
        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>  
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <h3>Confiez-nous vos rêves d'évasion : </h3>
                    <h4>en famille ou entre amis, nous trouverons la formule qui comblera vos attentes.</h4>       
                </div>
                <div class="carousel-item">
                    <h3>Accédez à l'expertise de nos spécialistes : </h3>
                    <h4>ils vous accompagnent dans la réalisation de votre voyage.</h4>       
                </div>
                <div class="carousel-item">
                    <h3>Nous nous chargeons d'assurer :  </h3>
                    <h4>votre sécurité et de veiller à votre pleine sérénité pendant tout le long de votre voyage.</h4>       
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev" role="button">
                <span class="fas fa-chevron-left fa-2x"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next" role="button">
                <span class="fas fa-chevron-right fa-2x"></span>
            </a>
        </div>
    </section>
    <section class="appli">
        <div class="container-appli">
            <h2>Partez en voyage les mains dans les poches</h2>
            <img src="images/logo-appli.png">
            <br>
            <br>
            <img src="images/ios.png">
            <img src="images/google.png">
        </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Enfant</h5>
                    <button type="button" class="Fermer" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Pour les enfants de moins de 12 ans, bébé compris (à la date du premier trajet de la réservation) et accompagnés d'un adulte, c'est 2 tarifs 
                    uniques tout le temps :</p>
                    <p>8€ pour les départs et arrivées des gares de Paris Centre et Lille-Flandres*
                    5€ pour toutes les autres destinations !
                    *8€ au départ ou à l'arrivée de Lille-Flandres - Lyon Saint-Exupéry, Lille-Flandres - Avignon, Lille-Flandres - Aix en Provence et Lille-Flandres - Marseille.</p> 
                    <p>A partir de 12 ans, votre enfant doit s’acquitter d'un billet au tarif standard.</p>
                    <p>Le cosy de votre bébé peut être placé sur le siège réservé, gratuitement.</p>
                    <p>Une pièce d'identité ou le livret de famille doit être présenté lors de l’embarquement.</p>
                    <p>Bonus ! Concernant les bagages, chaque enfant / bébé possède les mêmes droits que les autres voyageurs ! (bagage à main et bagage cabine).</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bagages</h5>
                    <button type="button" class="Fermer" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Pour votre trajet, vous pouvez prendre avec vous :</p>
                    <p> Toutes vos plus belles valises ou sacs de voyage (rose et bleu de préférence…) avec vos plus jolis pulls, chemises, pantalons…
                    Les vélos mais jamais sans leur housse 120X90cm. Pour être incollable sur ce sujet, vous trouverez toutes les informations 
                    nécessaires sur la page voyager avec vélo ou trottinette.
                    Les trottinettes
                    Vos skis/surf sous housse (dimensions maximum de 2 mètres)
                    Votre violon, guitare, skateboard... rangés dans une housse 
                    Sans oublier, votre repas le plus savoureux !
                    Pour savoir si votre bagage est soumis à une option, cliquez sur la page Bagages autorisés.</p>
                    <p>En revanche, nous ne pouvons pas accepter :</p>
                    <p>les appareils électroménagers, téléviseurs
                    les cartons, cabas
                    Les armes, explosifs
                    Les pare-chocs (eh oui, c’est déjà arrivé !)
                    La glacière avec la pêche du jour. Eh oui, amis Marseillais, on a déjà vu ça aussi…
                    … Bref, tout ce qui n’est pas indispensable pour passer un bon séjour.</p>
                    <p>Vous souhaitez avoir plus d'information sur les bagages autorisés cliquez sur ce formulaire.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Départ</h5>
                    <button type="button" class="Fermer" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Les trains Hyperloop c’est plus de voyageurs à bord. Résultats ? Plus de monde à accueillir. Alors rendez-vous 30 minutes avant le départ 
                    pour permettre le bon déroulement des procédures de sécurité et de contrôle et pour assurer un départ à l’heure et dans la bonne humeur !</p>
                    <p class="text-danger">L’accès au train est refusé 5 minutes avant le départ.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bar</h5>
                    <button type="button" class="Fermer" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Rendez vous directement dans notre bar pour avoir accès à la carte</p>
                    <p>OU</p>
                    <p>Cliquez sur ce lien : <a href="../Hyperloop-bar/index.php" target="blank">Hyperloop-Bar</a> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("View/login.php"); ?>
    <?php require_once("View/footer.php"); ?>
</body>
</html>