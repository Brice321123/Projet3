<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>ID Train</th><th>Nb étage</th><th>Heure départ</th><th>Heure arrivée</th><th>Distance</th><th>Type</th><th>ID gare départ</th><th>ID gare arrivée</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['id_tr']."</td>
					<td>".$unResultat['etage_tr']."</td>
					<td>".$unResultat['depart_tr']."</td>
					<td>".$unResultat['arrivee_tr']."</td>
					<td>".$unResultat['distance_tr']."</td>
					<td>".$unResultat['id_ty']."</td>
					<td>".$unResultat['id_ga_depart']."</td>
					<td>".$unResultat['id_ga_arrivee']."</td>
					<td><a title='Modification' href='menu_site.php?page=2&idt=".$unResultat['id_tr']."'> 
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