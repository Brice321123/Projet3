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
			 		<input type="number" class="form-control" name="id_ty" placeholder="ID" value="<?php echo $_SESSION['Champ1'];?>">
			 	</div>
				<div class="col">
			  		<label>Libellé =</label>
			 		<input type="text" class="form-control" name="lib_ty" placeholder="Libellé type" value="<?php echo $_SESSION['Champ2'];?>">
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



