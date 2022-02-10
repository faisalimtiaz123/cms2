<?php


	
// echo date("l jS \of F Y h:i:s A");


	



	session_start();


	$connection = new mysqli("localhost", "faisal", "faisal", "cms2");

	$run_query = $connection->query("SELECT * FROM articles order by id DESC");




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


	<link rel="stylesheet" href="styles/index.css" />

	<link rel="stylesheet" href="styles/all.css" />
</head>
<body>
	
	<div class="container">
		<div class="header">
		
			<?php include('navbar.php'); ?>

		</div>

	<div class="content"> 
	
		<div class="centerbox">
			
			<h3>All articles</h3>


			


			
			<?php
				while( $result = mysqli_fetch_assoc($run_query) ){


					$queryuserinfo = "SELECT * FROM users WHERE id='".$result['user_id']."'";

					$run1 = $connection->query($queryuserinfo);

					$result1 = mysqli_fetch_assoc($run1);


					echo '<div class="post">
				
							<div class="featuredpicture">
								<img src="uploads/'.$result['attachment'].'" />
							</div>

							<div class="articledetails">
								<h4>
									'.$result['title'];

									if( $_SESSION['uid'] == $result['user_id'] ){
										echo '&nbsp; &nbsp; &nbsp; &nbsp;<a class="actionicon" href="edit.php?id='.$result['id'].'">
										<i class="fas fa-edit"></i>
										</a>
									
									<a class="actionicon" href="delete.php?id='.$result['id'].'">
										<i class="fas fa-trash"></i>
									</a>';
									}

									

								echo '</h4>
								<p>
									'.$result['content'].'
								</p>
								<p>
									Posted by: '.$result1['fullname'].'
								</p>
								<p>
									'. date('jS M, Y h:i:s a', strtotime($result['date_added'])) .'
								</p>
							</div>

						</div>';

				}
			?>
			

		</div>

	</div>

</body>
</html>