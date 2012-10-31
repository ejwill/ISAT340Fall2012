<?php
	// set the return mime type to JSON
	header( 'content-type: application/json' );
	
	// connect to our DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// get the variables that are being passed in
	$sid = $_POST[ 'studentID' ];
	$cid = $_POST[ 'courseID'  ];
	
	// write my SQL query
	$sql = "DELETE FROM studentscourses " . 
		   "WHERE studentID = $sid AND " . 
				 "courseID  = $cid";
	
	// execute the query and store the result
	$result = $db->query( $sql );
	
	if ( true === $result ) {
		echo json_encode( (object) array( 'success' => 1, 'message' => 'Success!' ) );
	} else {
		echo json_encode( (object) array( 'success' => 0, 'message' => $db->error ) );
	}