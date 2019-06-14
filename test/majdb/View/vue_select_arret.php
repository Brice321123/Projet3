<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>Gare arrêt</th><th>Train</th><th>Heure arrivée</th><th>Heure départ</th><th>Distance</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['id_ga']."</td>
					<td>".$unResultat['id_tr']."</td>
					<td>".$unResultat['arrivee_ar']."</td>
					<td>".$unResultat['depart_ar']."</td>
					<td>".$unResultat['distance_ar']."</td>
					<td><a title='Modification' href='menu_site.php?page=6&idt1=".$unResultat['id_ga']."&idt2=".$unResultat['id_tr']."'> 
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