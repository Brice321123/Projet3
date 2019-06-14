<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>Date</th><th>Train</th><th>Nb place</th><th>Nb place libre</th><th>Prix</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['date_ca']."</td>
					<td>".$unResultat['id_tr']."</td>
					<td>".$unResultat['nbplacetotal']."</td>
					<td>".$unResultat['nbplacelibre']."</td>
					<td>".$unResultat['prix']."</td>
					<td><a title='Modification' href='menu_site.php?page=4&idt1=".$unResultat['date_ca']."&idt2=".$unResultat['id_tr']."'> 
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