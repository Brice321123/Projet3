<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
				<div class="col">
			  		<label>Identifiant Voyageur</label>
					<input type="number" class="form-control" name="id_vo" placeholder="ID" value="<?php echo $_SESSION['Champ1'];?>">
				</div>
				
	    		<div class="col">
			  		<label>Nom voyageur :</label>
                    <input type="text" class="form-control" name="nom_vo" placeholder="Nom voyageur" value="<?php echo $_SESSION['Champ2'];?>">
			 	</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
			  		<label>Réduction</label>
			 		<input type="number" class="form-control" name="reduction_vo" placeholder="Réduction" value="<?php echo $_SESSION['Champ3'];?>">
				</div>
	    		<div class="col">
			  		<label>Identifiant réservation :</label>
                    <select class="form-control" name="id_re">
					<?php 
						$resultats = $unControleur->selectAll('reservation');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['id_re'] == $_SESSION['Champ4']) {$sel="selected"; $trouve=1; }else {$sel="";}
                            echo "<option value='".$unResultat['id_re']."' ".$sel.">".$unResultat['id_re']." ".$unResultat['id_tr']."</option>";	
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



