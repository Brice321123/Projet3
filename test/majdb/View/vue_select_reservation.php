<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>Identifiant</th><th>Nombre de voyageur</th><th>Aller Retour (0/1)</th><th>Date aller</th><th>Train aller</th><th>Train retour</th><th>Date retour</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['id_re']."</td>
					<td>".$unResultat['nbvoyageur_re']."</td>
					<td>".$unResultat['allerretour_re']."</td>
					<td>".$unResultat['date_ca']."</td>
					<td>".$unResultat['id_tr']."</td>
					<td>".$unResultat['id_tr_Train']."</td>
					<td>".$unResultat['date_ca_Calendrier']."</td>
					<td><a title='Modification' href='menu_site.php?page=7&idt=".$unResultat['id_re']."'> 
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