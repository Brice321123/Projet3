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




<?php
require "database.php";
	$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";
	
	if(!empty($_POST)) {
		$name               = checkInput($_POST['name']);
        $description        = checkInput($_POST['description']);
        $price              = checkInput($_POST['price']);
        $category           = checkInput($_POST['category']); 
        $image              = checkInput($_FILES["image"]["name"]);
        $imagePath          = '../images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
		
		 if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
		
		 if(empty($description))
        {
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
		
		 if(empty($price)) 
        {
            $priceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
		
		 if(empty($category)) 
        {
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
		
		 if(empty($image)) 
        {
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } else {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
		if($isSuccess && $isUploadSuccess) {
			$db = Database::connect();
			$statement = $db->prepare("UPDATE items SET id =  WHERE id_etudiant = ? ;");
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: index.php");
		}
	}
	function checkInput($data) 
    {
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
				<h1><strong>Ajouter un item</strong></h1>
				<br>
				<form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Nom : </label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nom" value=" <?php echo $name; ?>">
						<span class="help-inline"><?php echo $nameError; ?></span>
					</div>
					<div class="form-group">
						<label for="description">Description : </label>
						<input type="text" class="form-control" id="description" name="description" placeholder="Description" value=" <?php echo $description; ?>">
						<span class="help-inline"><?php echo $descriptionError; ?></span>
					</div>
					<div class="form-group">
						<label for="price">Prix : (en €) </label>
						<input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value=" <?php echo $price; ?>">
						<span class="help-inline"><?php echo $priceError; ?></span>
					</div>
					<div class="form-group">
						<label for="category">Catégorie : </label>
						<select class="form-control" id="category" name="category">
							<?php 
								$db = Database::connect();
								foreach($db->query("SELECT * FROM categories") as $row) {
									echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
								}
								Database::disconnect();
							?>
						</select>
						<span class="help-inline"><?php echo $categoryError; ?></span>
					</div>
					<div class="form-group">
						<label for="image">Selectionner une image : </label>
						<input type="file" id="image" name="image">
						<span class="help-inline"><?php echo $imageError; ?></span>
					</div>					
					<div class="form-actions">
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
						<a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>