<footer class="page-footer font-small stylish-color-dark pt-4">
    <div class="container text-center text-md-left">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Rapprochons-nous !</h5>
                <p>Grâce à notre nouveau train l'Hyperloop, vous pouvez effectuer vos déplacements sans vous soucier du temps qu'il mettra.</p>
            </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-2 mx-auto">
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">A DÉCOUVRIR</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Destination Paris</a>
                    </li>
                    <li>
                        <a href="#!">Destination Disney</a>
                    </li>
                    <li>
                        <a href="#!">Destination Lille</a>
                    </li>
                    <li>
                        <a href="#!">Destination Roubaix</a>
                    </li>
                </ul>
            </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-2 mx-auto">
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">TRAJETS</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Billets Paris</a>
                    </li>
                    <li>
                        <a href="#!">Billets Marseille</a>
                    </li>
                    <li>
                        <a href="#!">Billets Lyon </a>
                    </li>
                    <li>
                        <a href="#!">Billets Avignon</a>
                    </li>
                </ul>
            </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-2 mx-auto">
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Informations</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Nous rejoindres !</a>
                    </li>
                    <li>
                        <a href="#!">On recrute</a>
                    </li>
                    <?php
                        if (isset($resultat['login'])) { 
                           echo "";
                        }else {
                            echo"<li><a data-toggle='modal' data-target='#login' href=''>Se connecter</a></li>";
                            echo"<li><a href='inscription.php'>S'inscrire</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <ul class="list-unstyled list-inline text-center py-2">
        <li class="list-inline-item">
            <h5 class="mb-1">Envie d'être tenu au courant de tous nos bons plans et de toutes nos offres ? Inscrivez-vous vite à la newsletter !</h5>
        </li>
    </ul>
    <ul>
        <li>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="S'inscrire à la newsletter" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">OK</button>
                </div>
            </div>
        </li>
    </ul>
    <hr>
    <p>Suivez-nous sur les réseaux sociaux !</p>
    <ul class="list-unstyled list-inline text-center">
        <li class="list-inline-item">
            <a class="btn-floating btn-fb mx-1">
                <i class="fab fa-facebook-f"> </i>
            </a>
        </li>
        <li class="list-inline-item">
            <a class="btn-floating btn-tw mx-1">
                <i class="fab fa-twitter"> </i>
            </a>
        </li>
        <li class="list-inline-item">
            <a class="btn-floating btn-gplus mx-1">
                <i class="fab fa-google-plus-g"> </i>
            </a>
        </li>
        <li class="list-inline-item">
            <a class="btn-floating btn-li mx-1">
                <i class="fab fa-linkedin-in"> </i>
            </a>
        </li>
        <li class="list-inline-item">
            <a class="btn-floating btn-dribbble mx-1">
                <i class="fab fa-dribbble"> </i>
            </a>
        </li>
    </ul>
    <div class="footer-copyright text-center py-3">© HYPERLOOP/RESERVATION - BRICE BEDOT - NATHAN PODESTA - LAMINE DIAME</div>
    <div><a href="mentionlegales.php">Mentions légales</a></div>
</footer>