<?php

	$error = '';
	$success = '';
	$fullname = '';
	$email = '';
	$password = '';

	if( $_SERVER['REQUEST_METHOD']=='POST' ){

		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if( $fullname=='' || $email=='' || $password=='' ){
			$error = 'Please fill all the fields.';
		}else{


			if( strlen($password) <= 3 || strlen($password) >= 8 ){
				$error = 'Your password should be between 3 to 8 charactors';
			}else{

				// if( condition ){
				// 	echo 'your password must be strong.';
				// }

				// if( email is not correct ){
				// 	$error = 'email not valid';
				// }else{
					
				// }


				// db insert
				$connection = new mysqli("localhost", "faisal", "faisal", "cms2");

				$selectquery = "SELECT * FROM users WHERE email='$email'";
				$query_run = $connection->query($selectquery);

				// echo mysqli_num_rows($query_run);

				if( mysqli_num_rows($query_run) >= 1 ){
					$error = 'Sorry this email already exists. Please login';
				}else{
					$encryptedpassword = md5($password);

					$query = "INSERT INTO users SET 
							  fullname='$fullname',
							  email='$email',
							  password='$encryptedpassword'
							  ";

					$connection->query($query);

					$success = 'You have been successfully registered. Please LOGIN now';

					$fullname = '';
					$email = '';
					$password = '';
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
		
		<h3>Become a member</h3>

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
		

		<form action="signup.php" method="POST">
			
			<input type="text" name="fullname" placeholder="Enter your name" class="textfield" value="<?php echo $fullname; ?>" />
			
			<input type="text" name="email" placeholder="Enter your email" class="textfield" value="<?php echo $email; ?>" />

			<input type="password" name="password" placeholder="Enter your password" class="textfield" value="<?php echo $password; ?>" />
			
			<input type="submit" value="Register" class="btn" /> 


		</form>

	</div>

</body>
</html>