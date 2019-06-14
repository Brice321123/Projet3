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
	            <h2>MENTION LEGALES</h2>
	        </div>
		<div class="container"> 
        <p>
            <h2>
            Politique de confidentialité de l’application Hyperloop
            </h2>
            <p>
            Afin de recevoir des informations sur vos données personnelles, les fins et les parties, avec que les données sont partagées, contacter le propriétaire.
            </p>
            <div class="black-divider"></div>
            <h2>
            Propriétaire et responsable du traitement
            </h2>
            <p>
            12 rue de Cléry, 75002, Paris
            </p>
            <p>
            n.podesta@cfa-insta.fr
            </p>
             <div class="black-divider"></div>
            <h2>
            Types de données collectées
            </h2>
            <p>
            Le propriétaire ne fournit pas une liste des types de données à caractère personnel collectées.
            </p>
            <p>
            Autres données à caractère personnel recueillies peuvent être décrites dans d’autres sections de cette politique de confidentialité ou de texte d’explication dédiée               contextuellement avec la collecte des données.
            Les données personnelles peuvent être librement fournies par l’utilisateur ou collectées automatiquement lors de l’utilisation de cette Application.
            Toute utilisation des Cookies - ou d’autres outils de suivi - par cette Application ou par les titulaires de services de tiers utilisés par cette Application, à moins             d’indication contraire, sert à identifier les utilisateurs et n’oubliez pas de leurs préférences, dans le seul but de fournir le service requis par l’utilisateur.
            Défaut de fournir certaines données personnelles peut-être rendre impossible pour cette Application fournir ses services.
            </p>
            <p>
            Les utilisateurs sont responsables de toutes les données personnelles de tiers obtenus, publié ou partagé par le biais de cette Application et confirmer qu’ils ont le             consentement du tiers pour fournir les données au propriétaire.
            </p>
            <p>
            Mode et le lieu du traitement des données
            </p>
             <div class="black-divider"></div>
            <h2>
            Méthodes de traitement
            </h2>
            <p>
            Le contrôleur des données traite les données des utilisateurs d’une manière appropriée et prennent des mesures de sécurité appropriées afin d’empêcher tout accès non             autorisé, divulgation, modification ou destruction non autorisée des données.
            Le traitement est effectué à l’aide d’ordinateurs et/ou elle activée, outils, procédures organisationnelles suivantes et modes strictement liées aux fins indiquées.               En plus, dans certains cas, le contrôleur des données, les données peuvent être accessibles à certains types de responsables, impliqué dans le fonctionnement du site             (administration, ventes, marketing, juridique, administration système) ou de parties externes (tels que des tiers prestataires de services techniques, factrices,                 hébergement fournisseurs, sociétés, agences de communication) nommé, si nécessaire, comme des processeurs de données par le propriétaire. La liste actualisée de ces               parties peut-être être demandée auprès du contrôleur des données à tout moment.
            </p>
             <div class="black-divider"></div>
            <h2>
            Place
            </h2>
            <p>
            Les données sont traitées dans les bureaux de fonctionnement du contrôleur des données et dans tous les autres endroits où se trouvent les parties concernées par le               traitement. Pour plus amples renseignements, veuillez communiquer avec le contrôleur des données.
            </p>
             <div class="black-divider"></div>
            <h2>
            Temps de rétention
            </h2>
            <p>
            Les données sont conservées pendant le temps nécessaires pour fournir le service demandé par l’utilisateur, ou indiqué par les raisons décrites dans ce document, et               l’utilisateur peut toujours demander que le contrôleur des données de suspendre ou supprimer les données.
            </p>
             <div class="black-divider"></div>
            <h2>
            L’utilisation des données recueillies
            </h2>
            <p>
            Les données à caractère personnel utilisés pour chaque usage est décrit dans les sections spécifiques du présent document.
            </p>
             <div class="black-divider"></div>
            <h2>
            Informations de base
            </h2>
            <p>
            Par défaut, cela inclut certaines données utilisateur telles que des id, nom, photo, sexe et leur paramètres régionaux. Certaines connexions de l’utilisateur, comme               les amis, sont également disponibles. Si l’utilisateur a effectué plus de leurs données publiques, plus d’informations seront disponibles.
            </p>
            <p>
            Plus d’informations sur la collecte de données et le traitement
            </p>
             <div class="black-divider"></div>
            <h2>
            Action en justice
            </h2>
            <p>
            Les données personnelles de l’utilisateur peuvent servir à des fins juridiques par le contrôleur des données, dans la Cour ou dans les étapes menant à une éventuelle             intervention juridique découlant d’une mauvaise utilisation de cette Application ou les services connexes.
            L’utilisateur déclare pour être le responsable du traitement peut avoir besoin de révéler des données personnelles sur demande des autorités publiques.
            </p>
             <div class="black-divider"></div>
            <h2>
            Plus d’informations sur les données personnelles de l’utilisateur
            </h2>
            <p>
            Outre les informations contenues dans la présente politique de confidentialité, cette Application peut fournir une aide contextuelle de renseignements concernant des             services particuliers ou à la collecte et de traitement des données personnelles sur demande.
            </p>
             <div class="black-divider"></div>
            <h2>
            Journaux système et maintenance
            </h2>
            <p>
            Pour une utilisation et des fins de maintenance, cette Application et tous les services tiers peuvent recueillir des fichiers qui enregistrent une interaction avec               cette Application (fichiers journaux) ou l’utilisation à cet effet des autres données personnelles (telles que l’adresse IP).
            </p>
             <div class="black-divider"></div>
            <h2>
            Information non contenue dans la présente politique
            </h2>
            <p>
            Plus de détails concernant la collecte ou de traitement des données à caractère personnel peuvent être demandés auprès du contrôleur des données à tout moment.                   Veuillez consulter les informations de contact au début de ce document.
            </p>
            <div class="black-divider"></div>
            <h2>
            Les droits des utilisateurs
            </h2>
            <p>
            Les utilisateurs ont le droit, à tout moment, de savoir si leurs données personnelles a été stockée et peut consulter le contrôleur des données pour en savoir plus               sur leur contenu et leur origine, afin de vérifier leur exactitude ou de demander à être complétées, annulé, mis à jour ou corrigée, ou pour leur transformation en               format anonyme ou de bloquer toute donnée contenue dans la violation de la loi, ainsi que pour s’opposer à leur traitement pour toutes les raisons légitimes. Demandes             doivent être envoyées au contrôleur de données sur les coordonnées énoncées ci-dessus.
            </p>
            <p>
            Cette Application ne supporte pas les demandes de « Faire pas de piste ».
            Pour déterminer si un service tiers qu'utilise honorer les demandes de « Faire pas de piste », s’il vous plaît lire leur politique de confidentialité.
            </p>
             <div class="black-divider"></div>
            <h2>
            Modifications apportées à cette politique de confidentialité
            </h2>
            <p>
            Le contrôleur des données se réserve le droit d’apporter des modifications à cette politique de confidentialité à tout moment en donnant un avis à ses utilisateurs               sur cette page. Il est fortement recommandé de vérifier cette page souvent, se référant à la date de la dernière modification figurant en bas. Si un utilisateur                   s’oppose à l’un des changements à la politique, l’utilisateur doit cesser à l’aide de cette Application et peut demander que le contrôleur des données de supprimer               les données personnelles. Sauf indication contraire, la politique de confidentialité alors en vigueur s’applique à toutes les données personnelles, le contrôleur des             données a sur les utilisateurs.
            </p>
        </p>
        </div>
    </section>
    <?php require_once("View/login.php");?>
    <?php require_once("View/footer.php");?>
    </body>
</html>