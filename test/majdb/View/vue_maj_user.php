<section class="insert">
	<div class="red-divider"></div>
	<div class="heading">
		<h2><?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-row">
	    		<div class="col">
			  		<label>Identifiant :</label>
			 		<input type="number" class="form-control" name="iduser" placeholder="ID" value="<?php echo $_SESSION['Champ1'];?>">
			 	</div>
				<div class="col">
			  		<label>Login :</label>
			 		<input type="text" class="form-control" name="login" placeholder="Login" value="<?php echo $_SESSION['Champ2'];?>">
				</div>
			</div>
			<br>
			<div class="form-row">
	    		<div class="col">
			  		<label>Mdp :</label>
			 		<input type="password" class="form-control" name="mdp" placeholder="Mot de passe" value="<?php echo $_SESSION['Champ3'];?>">
				</div>
				<div class="col">
			  		<label>Nom :</label>
			 		<input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo $_SESSION['Champ4'];?>">
				</div>
			</div>
			<br>
			<div class="form-row">
	    		<div class="col">
				  <label>Prénom :</label>
				  <input  type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php echo $_SESSION['Champ5'];?>">
				</div>
				<div class="col">
			  		<label>Genre :</label>
                      <?php 
						echo "<select class='form-control' name='genre'>";
						$tab[0]='MR';$tab[1]='MME';$tab[2]='MLE';
						echo "<option value='".$_SESSION['Champ6']."' selected>".$_SESSION['Champ6']."</option>";
						for ($i = 0; $i <= 2; $i++) {
							if ($tab[$i] != $_SESSION['Champ6']) {
							echo "<option value='".$tab[$i]."'>".$tab[$i]."</option>";
							}
						}
    					echo "</select>";
                     ?>
				</div>
			</div>
			<br>
			<div class="form-row">
				<div class="col">
					<label>Numéro :</label>
					<input  type="number" class="form-control" name="numero" placeholder="Numéro de téléphone" value="<?php echo $_SESSION['Champ7'];?>">
				</div>				
				<div class="col">
					<label>Date de naissance :</label>
					<input  type="date" class="form-control" name="naissance" placeholder="Date de naissance" value="<?php echo $_SESSION['Champ8'];?>">
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