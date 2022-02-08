<?php

	session_start();


	if( $_SESSION['uid']!='' ){
		header("Location: index.php");
	}


	$error = '';
	$success = '';
	
	$email = '';
	$password = '';

	if( $_SERVER['REQUEST_METHOD']=='POST' ){

		$email = $_POST['email'];
		$password = $_POST['password'];

		if( $email=='' || $password=='' ){
			$error = 'Please fill all the fields.';
		}else{


			if( strlen($password) <= 3 || strlen($password) >= 8 ){
				$error = 'Your password should be between 3 to 8 charactors';
			}else{


				// db insert
				$connection = new mysqli("localhost", "faisal", "faisal", "cms2");

				$encypt = md5($password);

				$selectquery = "SELECT * FROM users WHERE email='$email' and password='$encypt'";
				$run_query = $connection->query($selectquery);

				if( mysqli_num_rows($run_query)==0 ){
					$error =  "Your password or emai does not match";
				}else{
					// success
					$result = mysqli_fetch_assoc($run_query);

					$_SESSION['uid'] = $result['id'];


					header("Location: index.php");

				}


			}


		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Poppins:ital,wght@0,400;0,700;1,900&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="styles/signup.css" />


</head>
<body>
	
	<div class="centerbox">
		
		<h3>Login from here</h3>

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
		

		<form action="login.php" method="POST">
			
			<input type="text" name="email" placeholder="Enter your email" class="textfield" value="<?php echo $email; ?>" />

			<input type="password" name="password" placeholder="Enter your password" class="textfield" value="<?php echo $password; ?>" />
			
			<input type="submit" value="Login" class="btn" /> 


		</form>

	</div>

</body>
</html>