<?php
require 'database.php';

	if(!empty($_GET['id']))
	{
		$id = checkInput($_GET['id']);
	}

	$db = Database::connect();
	$statement = $db->prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id
						WHERE items.id = ? ");

	$statement->execute(array($id));
	$items = $statement->fetch();
	Database::disconnect();

	function checkInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
		
?>

<!DOCTYPE html> 
<html>
	<head>
		<title>Burger Code</title>
	  	<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> BurgerCode <span class="glyphicon glyphicon-cutlery"></span></h1>
		<div class="container admin">
			<div class="row">
				<div class="col-sm-6">
					<h1><strong>Voir un items</strong></h1>
					<br>
					<form>
						<div class="form-group">
							<label>Nom : </label><?php echo ' ' . $items['name']; ?>
						</div>
						<div class="form-group">
							<label>Description : </label><?php echo ' ' .$items['description']; ?>
						</div>
						<div class="form-group">
							<label>Prix : </label><?php echo ' ' . number_format((float)$items['price'],2,'.','') . ' €' ?>
						</div>
						<div class="form-group">
							<label>Catégorie : </label><?php echo ' ' .$items['category']; ?>
						</div>
						<div class="form-group">
							<label>Image : </label><?php echo ' ' . $items['image']; ?>
						</div>					
					</form>
					<div class="form-actions">
						<a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
					</div>
					
				</div>
				<div class="col-sm-6 site">
					<div class="thumbnail">
						<img src="<?php echo '../images/' . $items['image']; ?>" alt="...">
						<div class="price"><?php echo number_format((float)$items['price'],2,'.','') . ' €' ?></div>
						<div class="caption">
							<h4><?php echo $items['name']; ?></h4>
							<p><?php echo $items['description']; ?></p>
							<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-cutlery"></span> Commander</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>