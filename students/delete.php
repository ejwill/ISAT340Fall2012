<?php
	// connect to DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// write our query
	$sql = "DELETE FROM students WHERE id = " . $_GET[ 'id' ];
	
	// execute the query
	$db->query( $sql );
	
	// redirect back to the student listing
	header( 'location: /340/index.php' );