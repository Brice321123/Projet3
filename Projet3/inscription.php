<?php
    session_start();
?>
<?php
    require_once("Controller/controller.php");
    $unControleur = new Controller ("localhost", "hyperloop", "root", "");


   $nom = $prenom = $telephone = $login = $nameErr = $confirmEmail = $mdp = $confirmMdp = $firstNameErr = $telErr = $emailErr = $confEmailErr = $mdpErr = $confMdpErr = "";

    if(isset($_POST['inscription'])) { 
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $telephone = $_POST["telephone"];
        $login = $_POST["login"];
        $confirmEmail = $_POST["confirmEmail"];
        $mdp = $_POST["mdp"];
        $confirmMdp = $_POST["confirmMdp"];
        $success = true;

        if (empty($nom)) {
            $nameErr = "Vous avez oublié votre nom ?";
            $success = false;
        }

        if (empty($prenom)) {
            $firstNameErr = "Vous avez oublié votre prenom ?";
            $success = false;
        }

        if (!isPhone($telephone)) {
             $telErr = "Que des chiffres et des espaces, stp...";
             $success = false;
        } elseif (empty($telephone)) {
            $telErr = "Vous avez oublié votre numéro de télephone ?";
            $success = false;
        }

        if (empty($login)) {
            $emailErr = "Vous avez oublié votre email ?";
            $success = false;
        } elseif (!isEmail($login)) {
            $emailErr = "Ce n'est pas un email valide !";
            $success = false;
        }else {
			$res = $unControleur->selectOne('utilisateur','login',$login);
			if ($res) {//Doublon
				$emailErr = "Identifiant déjà créé !";
				$success = false;
			}
		}
if (empty($confirmEmail)) {
            $confEmailErr = "Vous avez oublié de verifier votre email ?";
            $success = false;
        } elseif (!isEmail($confirmEmail)) {
            $confEmailErr = "Ce n'est pas un email valide !";
            $success = false;
        } elseif ($login != $confirmEmail) {
            $confEmailErr = "Les deux email ne correspondent pas";
            $emailErr = "Les deux email ne correspondent pas";
            $success = false;
        }

        if (empty($mdp)) {
            $mdpErr = "Vous avez oublié votre mot de passe ?";
            $success = false;
        }

        if (empty($confirmMdp)) {
            $confMdpErr = "Vous avez oublié de verifier votre mot de passe ?";
            $success = false;
        } elseif ($mdp != $confirmMdp) {
            $confMdpErr = "Les deux mot de passe ne correspondent pas";
            $mdpErr = "Les deux mot de passe ne correspondent pas";
            $success = false;
        }

        if ($success) {
             $date = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];
            $unControleur->insertUser($_POST, $date);
            $login = $_POST["login"];
            $mdp = $_POST["mdp"];
            //echo $mdp;
            $resultat = $unControleur->verifConnexion($login, $mdp);
            if (isset($resultat['login'])) {
                $_SESSION["iduser"] = $resultat['iduser'];
                $_SESSION["login"] = $resultat['login'];
                $_SESSION["mdp"] = $resultat['mdp'];
                $_SESSION["nom"] = $resultat['nom'];
                $_SESSION["prenom"] = $resultat['prenom'];
                $_SESSION["genre"] = $resultat['genre'];
                $_SESSION["telephone"] = $resultat['numero'];
                $_SESSION["naissance"] = $date;
                //header("Location:index.php");
				header("Location:".$_SESSION["page"]);
            }
        }
    }
    function isPhone ($var) {
        return  preg_match("/^[0-9 ]*$/",$var);
    }

    function isEmail ($var) {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
?>
<!DOCTYPE html>
<html>
    <?php require_once("View/header.php")?>
    <section id="inscription">
    <div class="blue-divider"></div>
        <div class="heading">
            <h2>S'inscrire</h2>
        </div>
        <div class="container">
            <form action="" method="post">
                Civilité :
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genre" id="homme" value="MR" checked>
                    <label class="form-check-label" for="inlineRadio1">M.</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genre" id="femme" value="MME">
                    <label class="form-check-label" for="inlineRadio2">Mme</label>
                </div>
               <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genre" id="femme" value="MLE">
                    <label class="form-check-label" for="inlineRadio3">Mle</label>
                </div>
                <br>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo $nom ?>">
                        <?php if(!empty($nameErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>"; 
                                    echo $nameErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" value="<?php echo $prenom ?>">
                         <?php if(!empty($firstNameErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>"; 
                                    echo $firstNameErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col col-lg-2">
                        <label for="jour">Jour</label>
                        <select class="custom-select custom-select-lg mb-3" name="jour">
                        <?php 
                            $i = 1;
                            while ($i <= 31) {
                                echo "<option value='".$i."'>".$i."</option>";
                                echo $i++;
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col col-lg-2">
                        <label for="mois">Mois</label>
                        <select class="custom-select custom-select-lg mb-3" name="mois">
                        <?php 
                            $resultats = array("1"=>"Janvier","2"=>"Février","3"=>"Mars","4"=>"Avril",
                                               "5"=>"Mai","6"=>"Juin","7"=>"Juillet","8"=>"Août","9"=>"Septembre",
                                               "10"=>"Octobre","11"=>"Novembre","12"=>"Décembre");
                            foreach ($resultats as $val=>$unResultat) { // Faire un val + 1 
                                echo "<option value='".$val ."'>".$unResultat."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col col-lg-2">
                        <label for="annee">Année</label>
                        <select class="custom-select custom-select-lg mb-3" name="annee">
                        <?php 
                            $i = 2019;
                            while ($i >= 1900) {
                                echo "<option value='".$i."'>".$i."</option>";
                                echo $i--;
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telephone">Téléphone</label>
                        <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Numéro de téléphone" value="<?php echo $telephone ?>">
                        <?php if(!empty($telErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>"; 
                                    echo $telErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email1">Email (identifiant de connexion)</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Email" value="<?php echo $login ?>">
                        <?php if(!empty($emailErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>"; 
                                    echo $emailErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmEmail">Confirmer Email</label>
                        <input type="text" class="form-control" name="confirmEmail" id="confirmEmail" placeholder="Confirmez votre email" value="<?php echo $confirmEmail ?>">
                        <?php if(!empty($confEmailErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>"; 
                                    echo $confEmailErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de Passe" value="<?php echo $mdp ?>">
                        <?php if(!empty($mdpErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>"; 
                                    echo $mdpErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmMdp">Confirmer Mot de passe</label>
                        <input type="password" class="form-control" name="confirmMdp" id="confirmMdp" placeholder="Confirmez votre Mot de passe" value="<?php echo $confirmMdp ?>">
                        <?php if(!empty($confMdpErr)) {
                            echo "<div class='alert alert-danger' role='alert'>";
                                echo "<strong>";
                                    echo $confMdpErr;
                                echo "</strong>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
                <br>
                <center><button type="submit" name="inscription" class="btn btn-primary">S'inscrire</button></center>
            </form>
        </div>
    </section>
    <?php require_once("View/login.php");?>
    <?php require_once("View/footer.php")?>
    </body>
</html>