<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
	    		<div class="col">
			  		<label>Identifiant</label>
					<input type="number" class="form-control" name="id_bi" placeholder="ID" value="<?php echo $_SESSION['Champ1'];?>">
			 	</div>
	    		<div class="col">
			  		<label>ID utilisateur :</label>
					<select class="form-control" name="iduser">
					<?php 
						$resultats = $unControleur->selectAll('utilisateur');
						$trouve=0;
						foreach ($resultats as $unResultat) {
							if ($unResultat['iduser'] == $_SESSION['Champ2']) {$sel="selected"; $trouve=1; }else {$sel="";}
							echo "<option value='".$unResultat['iduser']."' ".$sel.">".$unResultat['iduser']." ".$unResultat['login']."</option>";									
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
			  		<label>Billet</label>
			 		<input type="text" class="form-control" name="texte_bi" placeholder="Billet" value="<?php echo $_SESSION['Champ3'];?>">
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



