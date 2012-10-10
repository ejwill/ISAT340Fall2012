<?php
	// connect to DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// write our query
	$sql = "DELETE FROM courses WHERE id = " . $_GET[ 'id' ];
	
	// execute the query
	$db->query( $sql );
	
	// redirect back to the course listing
	header( 'location: /340/courses/index.php' );