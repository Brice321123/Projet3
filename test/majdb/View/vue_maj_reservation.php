<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
				<div class="col">
			  		<label>Identifiant =</label>
			 		<input type="number" class="form-control" name="id_re" placeholder="ID" value="<?php echo $_SESSION['Champ1'];?>">
				</div>
				
	    		<div class="col">
			  		<label>Nombre de voyageur :</label>
			 		<input type="number" class="form-control" name="nbvoyageur_re" placeholder="Nombre de voyageur" value="<?php echo $_SESSION['Champ2'];?>">
			 	</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
			  		<label>Aller retour :</label>
 					<select class="form-control" name="allerretour_re">
                     <?php 
						$tab[0]='0';$tab[1]='1';
						$trouve=0;
						for ($i = 0; $i <= 1; $i++) {
							if ($tab[$i] == $_SESSION['Champ3']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$tab[$i]."' ".$sel.">".$tab[$i]."</option>";									
							}
                     ?>
					</select>
 				</div>
	    		<div class="col">
			  		<label>Date aller :</label>
					<select class="form-control" name="date_ca">
					<?php 
						$resultats = $unControleur->selectAll('calendrier');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['date_ca'] == $_SESSION['Champ4']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['date_ca']."' ".$sel.">".$unResultat['date_ca']." ".$unResultat['lib_ca']."</option>";									
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
				  <label>Train aller :</label>
					<select class="form-control" name="id_tr">
					<?php 
						$resultats = $unControleur->selectAll('train');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['id_tr'] == $_SESSION['Champ5']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['id_tr']."' ".$sel.">".$unResultat['id_tr']." Départ à ".$unResultat['depart_tr']." - Arrivée à ".$unResultat['arrivee_tr']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}						
					?>
					</select>
				</div>
	    		<div class="col">
			  		<label>Train retour =</label>
					<select class="form-control" name="id_tr_Train">
					<?php 
						$resultats = $unControleur->selectAll('train');
						$trouve=0;
						echo "<option value=''></option>";
						foreach ($resultats as $unResultat) {
							if ($unResultat['id_tr'] == $_SESSION['Champ6']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['id_tr']."' ".$sel.">".$unResultat['id_tr']." Départ à ".$unResultat['depart_tr']." - Arrivée à ".$unResultat['arrivee_tr']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}						
					?>
					</select>
				</div>
	    		<div class="col">
			  		<label>Date retour =</label>
					<select class="form-control" name="date_ca_Calendrier">
					<?php 
						$resultats = $unControleur->selectAll('calendrier');
						$trouve=0;
						echo "<option value=''></option>";
						foreach ($resultats as $unResultat) {
							if ($unResultat['date_ca'] == $_SESSION['Champ7']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['date_ca']."' ".$sel.">".$unResultat['date_ca']." ".$unResultat['lib_ca']."</option>";									
						}
						if ($trouve == 0) {//Selected non trouvé
							echo "<option value='' selected></option>";
						}	
					echo "trouve=".$trouve;						
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



