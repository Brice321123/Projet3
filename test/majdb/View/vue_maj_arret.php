<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
				<div class="col">
			  		<label>Identifiant Gare :</label>
					<select class="form-control" name="id_ga">
					<?php 
						$resultats = $unControleur->selectAll('gare');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['id_ga'] == $_SESSION['Champ1']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['id_ga']."' ".$sel.">".$unResultat['id_ga']." ".$unResultat['nom_ga']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}						
					?>
					</select>
				</div>
				
	    		<div class="col">
			  		<label>Identifiant Tain :</label>
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
			  		<label>Heure d'arrivée :</label>
			 		<input type="time" class="form-control" name="arrivee_ar" placeholder="Heure arrivée " value="<?php echo $_SESSION['Champ3'];?>">
				</div>

	    		<div class="col">
			  		<label>Heure départ :</label>
			 		<input type="time" class="form-control" name="depart_ar" placeholder="Heure départ" value="<?php echo $_SESSION['Champ4'];?>">
				</div>
	    		<div class="col">
				  <label>Distance :</label>
				  <input type="number" class="form-control" name="distance_ar" placeholder="Distance" value="<?php echo $_SESSION['Champ5'];?>">
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



