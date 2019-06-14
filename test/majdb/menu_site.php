<!DOCTYPE html>
<html>
	<head>
		<title> Màj BD Hyperloop </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link rel="stylesheet" href="css/style1.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" language="Javascript" src="js/script.js"></script>
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60">
		<nav class="navbar navbar-expand-md navbar-dark sticky-top">
			<a class="navbar-brand" href="#"></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
					<i class="fas fa-bars fa-lg"></i>
			</button>

			<div class="collapse navbar-collapse justify-content-center" id="myNavbar">
				<ul class="nav nav-pills navbar-nav">
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=1">Gare</a></li>
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=2">Train</a></li>
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=3">Calendrier</a></li>
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=4">Circuler</a></li>
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=5">Type</a></li>
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=6">S'arrêter</a></li>
					<li class="nav-item"><a class="nav-link" href="menu_site.php?page=7">Réservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu_site.php?page=8">Voyageur</a></li>
                     <li class="nav-item"><a class="nav-link" href="menu_site.php?page=9">Billet</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu_site.php?page=20">Utilisateur</a></li>
					<li class="nav-item"><a class="nav-link" href="../index.php"><font color="black">Déconnexion</font></a></li>
				</ul>
			</div>
		</nav>
	<?php
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 0;
	}

	switch ($page) {
		case 1 : require_once("gestion_gare.php"); break;
		case 2 : require_once("gestion_train.php"); break;
		case 3 : require_once("gestion_calendrier.php"); break;
		case 4 : require_once("gestion_circuler.php"); break;
		case 5 : require_once("gestion_type.php"); break;
		case 6 : require_once("gestion_arret.php"); break;
		case 7 : require_once("gestion_reservation.php"); break;
        case 8 : require_once("gestion_voyageur.php"); break;
        case 9 : require_once("gestion_billet.php"); break;
		case 20 : require_once("gestion_user.php"); break;
		default : session_start();
				session_destroy();
				header("Location: ../index.php");
				break;
	}

	?>
	</body>
</html>
