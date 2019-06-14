<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>ID User</th><th>Login</th><th>MDP</th><th>Nom</th><th>Prénom</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['iduser']."</td>
					<td>".$unResultat['login']."</td>
					<td>".$unResultat['mdp']."</td>
					<td>".$unResultat['nom']."</td>
					<td>".$unResultat['prenom']."</td>
					<td>".$unResultat['genre']."</td>
					<td>".$unResultat['numero']."</td>
					<td>".$unResultat['naissance']."</td>
					<td><a title='Modification' href='menu_site.php?page=20&idt=".$unResultat['iduser']."'> 
							<img src ='images/modification.jpg' alt='Modification' height='25'/>
						</a>
                    </td>
					</tr>";
			    }
		  	?>
	  	</table>
	</div>
</section>

<footer>
 	<div class="black-divider"></div>
   	<h5>© Hyperloop</h5>
</footer>