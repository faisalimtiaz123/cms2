<?php

	session_start();


	$connection = new mysqli("localhost", "faisal", "faisal", "cms2");

	$run_query = $connection->query("SELECT * FROM articles");

	


?>

<?php include('header.php'); ?>
	
	<div class="centerbox">
		
		<h3>All articles</h3>
		
		<?php
			while( $result = mysqli_fetch_assoc($run_query) ){

				echo $result['title'].'<br />';
				echo $result['content'].'<br /><hr /><br />';

			}
		?>
		

	</div>

	</div>

</body>
</html>