<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Connexion</h5>
                <button type="button" class="Fermer" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Identifiant</label>
                        <input type="text" class="form-control" id="identifiant" aria-describedby="emailHelp" name="login" placeholder="Identifiant">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe">
                    </div>
                    <center>
                        <button type="submit" name="seConnecter" class="btn btn-primary">Me connecter</button>
                    </center>
                    <br>
                    <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous !</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>