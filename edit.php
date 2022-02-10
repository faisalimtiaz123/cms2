<?php

	session_start();

	$connection = new mysqli("localhost", "faisal", "faisal", "cms2");


	$artice_id = $_GET['id'];


	$query = "SELECT * FROM articles WHERE id='$artice_id'";

	$run = $connection->query($query);

	$result = mysqli_fetch_assoc($run);





	$error = '';
	$success = '';
	
	$title = '';
	$content = '';

	if( $_SERVER['REQUEST_METHOD']=='POST' ){

		$title = $_POST['title'];
		$content = $_POST['content'];

		$attachment = $_FILES['attachment']['name'];
		$tmp_attachment = $_FILES['attachment']['tmp_name'];

		if( $title=='' || $content=='' || $attachment=='' ){
			$error = 'Please fill all the fields.';
		}else{


			move_uploaded_file($tmp_attachment, 'uploads/'.$attachment);

			$insertQuery = "UPDATE articles SET 
							title='$title',
							content='$content',
							attachment='$attachment'

							where id='$artice_id'
							";

			

			$connection->query($insertQuery);

			$success = 'Article has been updated successfully!';


		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles/index.css" />

	<link rel="stylesheet" href="styles/add.css" />
</head>
<body>
	
	<div class="container">
		<div class="header">
		
			<?php include('navbar.php'); ?>

		</div>

		<div class="content"> 
	
	<div class="centerbox">
		
		<h3>Edit article from here</h3>

		<?php 
			if( $error!='' ){
				echo '<div class="error">'.$error.'</div>';
			}
		?>

		<?php 
			if( $success!='' ){
				echo '<div class="success">'.$success.'</div>';
			}
		?>
		

		<form action="" method="POST" enctype="multipart/form-data">
			
			<input type="text" name="title" placeholder="Enter article title" class="textfield" value="<?=$result['title']?>" />


			<textarea class="textfield" name="content" placeholder="Enter article body"><?=$result['content']?></textarea>

			<input type="file" name="attachment" class="textfield" />

			
			
			<input type="submit" value="Add Article" class="btn" /> 


		</form>

	</div>

	</div>

</body>
</html>