<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>Identifiant</th><th>Nom voyageur</th><th>Réduction</th><th>Identifiant réservation</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['id_vo']."</td>
					<td>".$unResultat['nom_vo']."</td>
					<td>".$unResultat['reduction_vo']."</td>
					<td>".$unResultat['id_re']."</td>
					<td><a title='Modification' href='menu_site.php?page=8&idt=".$unResultat['id_vo']."'> 
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