<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
				<div class="col">
			  		<label>Numéro du train :</label>
			 		<input type="number" class="form-control" name="id_tr" placeholder="N° Train" value="<?php echo $_SESSION['Champ1'];?>">
				</div>
				
	    		<div class="col">
			  		<label>Nombre d'étage :</label>
			 		<input type="number" class="form-control" name="etage_tr" placeholder="Nb étage" value="<?php echo $_SESSION['Champ2'];?>">
			 	</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
			  		<label>Heure de départ :</label>
			 		<input type="time" class="form-control" name="depart_tr" placeholder="HH:MM:SS" value="<?php echo $_SESSION['Champ3'];?>">
				</div>

	    		<div class="col">
			  		<label>Heure d'arrivée :</label>
			 		<input type="time" class="form-control" name="arrivee_tr" placeholder="HH:MM:SS" value="<?php echo $_SESSION['Champ4'];?>">
				</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
				  <label>distance en km :</label>
				  <input type="number" class="form-control" name="distance_tr" placeholder="Distance" value="<?php echo $_SESSION['Champ5'];?>">
				</div>

	    		<div class="col">
			  		<label>Type de train :</label>
					<select class="form-control" name="id_ty">
					<?php 
						$resultats = $unControleur->selectAll('type');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['id_ty'] == $_SESSION['Champ6']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['id_ty']."' ".$sel.">".$unResultat['id_ty']." ".$unResultat['lib_ty']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}						
					?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col">
				  <label>ID gare départ :</label>
				  <select class="form-control" name="id_ga_depart">
                   <?php 
                    $resultats = $unControleur->selectAll('gare');
					$trouve=0;
                    foreach ($resultats as $unResultat) {
						if ($unResultat['id_ga'] == $_SESSION['Champ7']) {$sel="selected"; $trouve=1; }else {$sel="";}
						echo "<option value='".$unResultat['id_ga']."' ".$sel.">".$unResultat['id_ga']." ".$unResultat['nom_ga']."</option>";									
					}
					if ($trouve == 0) {//Selected non trouvé
						echo "<option value='' selected></option>";
					}						
                  ?>
                   </select>
				</div>
				<div class="col">
				  <label>ID gare arrivée :</label>
				  <select class="form-control" name="id_ga_arrivee">
                   <?php 
                    $resultats = $unControleur->selectAll('gare');
					$trouve=0;
                    foreach ($resultats as $unResultat) {
						if ($unResultat['id_ga'] == $_SESSION['Champ8']) {$sel="selected"; $trouve=1; }else {$sel="";}
						echo "<option value='".$unResultat['id_ga']."' ".$sel.">".$unResultat['id_ga']." ".$unResultat['nom_ga']."</option>";									
					}
					if ($trouve == 0) {//Selected non trouvé
						echo "<option value='' selected></option>";
					}						
                  ?>
                   </select>
				</div>
			</div>
			<br>
		<table>
			<tr>
				<td><button type="reset" name="annuler" value="annuler" class="btn btn-danger">Annuler</button></td>
				<td><button type="submit" name="valider" value="valider" class="btn btn-info">Créer</button></td>
				<td><button type="submit" name="modifier" value="modifier" class="btn btn-info">Modifier</button></td>
			</tr>
		</table>
		</form>
	</div>
</section>



