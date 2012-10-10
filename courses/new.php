<?php
	// check to see if we're coming to this page after having
	// submitted the form
	if ( isset( $_POST[ 'title' ] ) ) {
	
		// we have values, let's try to insert new course into the db
		// connect
		$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
		
		// create a SQL statement
		$sql = $db->prepare(
			"INSERT INTO courses (title,code,difficulty) 
			 VALUES (?,?,?)");
		
		// extract our values from $_POST
		extract( $_POST );
		
		// bind parameters from our form
		$sql->bind_param( 'sss', $title, $code, $difficulty );
		
		// execute the query
		$sql->execute();
		
		// redirect back to the list of courses page
		header( "Location: /340/courses/index.php" );
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Add a Course</title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Add a New Course</h1>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="title">Title</label></th>
							<td><input type="text" name="title" id="title" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="code">Code</label></th>
							<td><input type="text" name="code" id="code" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="difficulty">Difficulty</label></th>
							<td>
								<select name="difficulty" id="difficulty">
									<option>Introductory</option>
									<option>Intermediate</option>
									<option>Advanced</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" value="Add Course" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>
</html>