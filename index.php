<?php

	session_start();

	// if user is not loged in
	if( $_SESSION['uid']=='' ){
		header("Location: login.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles/index.css" />
</head>
<body>
	
	<div class="container">
		<div class="header">
		
			<?php include('navbar.php'); ?>

		</div>

		<div class="content"> 
			
		</div>
	</div>

</body>
</html>	