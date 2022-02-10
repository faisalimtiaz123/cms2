<?php

	$article_id = $_GET['id'];

	$connection = new mysqli("localhost", "faisal", "faisal", "cms2");

	$query = "DELETE FROM articles WHERE id='$article_id'";

	$connection->query($query);

	header("Location: all.php");

?>