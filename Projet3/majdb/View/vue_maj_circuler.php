<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
				<div class="col">
			  		<label>Date :</label>
					<select class="form-control" name="date_ca">
					<?php 
						$resultats = $unControleur->selectAll('calendrier');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['date_ca'] == $_SESSION['Champ1']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['date_ca']."' ".$sel.">".$unResultat['date_ca']." ".$unResultat['lib_ca']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}						
					?>
					</select>
				</div>
				
	    		<div class="col">
			  		<label>N° Tain :</label>
					<select class="form-control" name="id_tr">
					<?php 
						$resultats = $unControleur->selectAll('train');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['id_tr'] == $_SESSION['Champ2']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['id_tr']."' ".$sel.">".$unResultat['id_tr']." Départ à ".$unResultat['depart_tr']." - Arrivée à ".$unResultat['arrivee_tr']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}						
					?>
					</select>
			 	</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
			  		<label>Nombre total de place =</label>
			 		<input type="number" class="form-control" name="nbplacetotal" placeholder="Nombre total de place " value="<?php echo $_SESSION['Champ3'];?>">
				</div>

	    		<div class="col">
			  		<label>Nombre de place libre =</label>
			 		<input type="number" class="form-control" name="nbplacelibre" placeholder="Nombre de place libre" value="<?php echo $_SESSION['Champ4'];?>">
				</div>
	    		<div class="col">
				  <label>Prix :</label>
				  <input type="number" step="0.01" class="form-control" name="prix" placeholder="Prix" value="<?php echo $_SESSION['Champ5'];?>">
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



