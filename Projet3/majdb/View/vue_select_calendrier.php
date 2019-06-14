<section class="select">
  	<div class="container">
	  	<input class="form-control" id="myInput" onkeyup="myFunction()" type="text" placeholder="Rechercher">
	    <br>
	    <table class="table table-bordered table-striped" id="myTable">
		    <?php
		    	echo "<thead><tr><th>Date calendrier</th><th>Libellé calendrier</th></tr></thead>";
			    foreach ($resultats as $unResultat) {
					echo "<tr><td>".$unResultat['date_ca']."</td>
					<td>".$unResultat['lib_ca']."</td>
					<td><a title='Modification' href='menu_site.php?page=3&idt=".$unResultat['date_ca']."'> 
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
   	<h5>© Hyperloop</h5>c
</footer>

