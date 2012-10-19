<?php
	// set the content type to be returned
	header( 'content-type: application/json' );

	// get access to the db
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// get the parameters that were POSTed
	$sid = $_POST[ 'studentID' ];
	$cid = $_POST[ 'courseID'  ];
	
	// write your query
	$sql = "INSERT INTO studentscourses (studentID,courseID)
			VALUES ($sid,$cid)";
			
	// execute the query
	$result = $db->query( $sql );
	
	if ( true == $result ) {
		echo '1';
	} else {
		echo '0';
	}
