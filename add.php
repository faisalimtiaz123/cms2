<?php

	session_start();



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

			$insertQuery = "INSERT INTO articles SET 
							user_id='".$_SESSION['uid']."',
							title='$title',
							content='$content',
							attachment='$attachment'
							";

			$connection = new mysqli("localhost", "faisal", "faisal", "cms2");

			$connection->query($insertQuery);

			$success = 'New article has been posted.';


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
		
		<h3>Add article from here</h3>

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
		

		<form action="add.php" method="POST" enctype="multipart/form-data">
			
			<input type="text" name="title" placeholder="Enter article title" class="textfield" />


			<textarea class="textfield" name="content" placeholder="Enter article body"></textarea>

			<input type="file" name="attachment" class="textfield" />

			
			
			<input type="submit" value="Add Article" class="btn" /> 


		</form>

	</div>

	</div>

</body>
</html>