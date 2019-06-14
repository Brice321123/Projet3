<head>
    <title>Hyperloop - Réservation</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script scr="js/script.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="60">
    <nav class="navbar fixed-top navbar-expand-md navbar-dark sticky-top">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar"><i class="fas fa-bars fa-lg"></i></button>
        <div class="collapse navbar-collapse justify-content-center" id="myNavbar">
            <ul class="nav nav-pills navbar-nav right">
                
                <?php
                    echo"<li class='nav-item'><a class='nav-link' href='index.php'>Accueil</a></li>";
                    echo"<li class='nav-item'><a class='nav-link' href='contact.php'>Contact</a></li>";
                    if ( isset ($_SESSION['login']) and !empty($_SESSION['login'])) { 
                      echo "<li class='nav-item dropdown'>";
                              echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>". $_SESSION['nom'] . "</a>";
                           echo"<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                              echo"<a class='dropdown-item' href='moncompte.php'>Mon Compte</a>";
                              echo"<div class='dropdown-divider'></div>";
                                  echo"<a class='dropdown-item' href='index.php?id=1'>Déconnexion</a>";                 
                            echo"</div>";
                        echo "</li>";
                        /*echo"<li class='nav-item'><a class='nav-link' href='moncompte.php'>Mon Compte</a></li>";
                        echo"<li class='nav-item'><a class='nav-link' href='index.php?id=1'>Déconnexion</a></li>";
                        echo "<li class='nav-item '><a class='nav-link'>". $_SESSION['nom'] . "</a></li>";*/
                     }else {
                        echo "<li class='nav-item'><a class='nav-link' data-toggle='modal' data-target='#login'>Connexion</a></li>";
                     }
                    echo"<li class='nav-item'><a class='nav-link' href='majdb/majdb.php'><font color='black'>Administrateur</font></a></li>";
                ?>
            </ul>
        </div>
    </nav>