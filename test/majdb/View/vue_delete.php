<section class="supprimer">
	<div class="red-divider"></div>
	<div class="heading">
		<h2>Suppression <?php echo $_SESSION['Champ0'];?></h2>
	</div>
	<div class="container">
		<form method="post" action="">
			<div class="form-group">
				<label>ID  <?php echo $_SESSION['Champ0'];?> : </label>
				<input type="text" class="form-control" name="idsupp" size="5" placeholder="<?php echo $_SESSION['delete'];?>" value="<?php echo $_SESSION['Champx'];?>">>
			</div>
			<button type="submit" name="supprimer" value="supprimer" class="btn btn-danger">Supprimer</button>
		</form>
	</div>
</section>
<br>