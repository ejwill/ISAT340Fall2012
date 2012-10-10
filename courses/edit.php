<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// check to see if we're coming to this page after having
	// submitted the form
	if ( isset( $_POST[ 'title' ] ) ) {
	
		// we have values, let's try to update a course in the db
		// create a SQL statement
		$sql = $db->prepare( "UPDATE courses 
							  SET 	 title = ?,
									 code = ?,
									 difficulty = ?
							  WHERE  ID = ?" );
							  
		// extract our values from $_POST
		extract( $_POST );
		
		// bind parameters from our form
		$sql->bind_param( 'sssi', $title, $code, $difficulty, $id );
		
		// execute the query
		$sql->execute();
		
		// redirect back to the list of courses page
		header( "Location: /340/courses/index.php" );
	} else {
		// get the id of the course passed in
		$id = $_GET[ 'id' ];
		
		// create a SQL statement
		$sql = "SELECT * FROM courses WHERE id = $id";
		
		// execute the query
		$result = $db->query( $sql );
		
		// get the data for this course
		$course = $result->fetch_assoc();
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Update a Course</title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Update a Course</h1>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<input type="hidden" name="id" value="<?php echo $course[ 'ID' ]; ?>" />
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="title">Title</label></th>
							<td><input type="text" name="title" id="title" value="<?php echo $course[ 'title' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="code">Code</label></th>
							<td><input type="text" name="code" id="code" value="<?php echo $course[ 'code' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="difficulty">Difficulty</label></th>
							<td>
								<select name="difficulty" id="difficulty">
									<option<?php echo ( 'Introductory' == $course[ 'difficulty' ] ) ? ' selected="selected"' : ''; ?>>Introductory</option>
									<option<?php echo ( 'Intermediate' == $course[ 'difficulty' ] ) ? ' selected="selected"' : ''; ?>>Intermediate</option>
									<option<?php echo ( 'Advanced'     == $course[ 'difficulty' ] ) ? ' selected="selected"' : ''; ?>>Advanced</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" value="Update Course" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>
</html>