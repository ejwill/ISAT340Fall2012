<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// check to see if we're coming to this page after having
	// submitted the form
	if ( isset( $_POST[ 'firstname' ] ) ) {
	
		// we have values, let's try to insert new student into the db
		// create a SQL statement
		$sql = $db->prepare( "UPDATE students 
							  SET 	 firstname = ?,
									 mi = ?,
									 lastname = ?,
									 ssn = ?,
									 address = ?,
									 zip = ?,
									 homephone = ?,
									 dob = ?,
									 gender = ?
							  WHERE  ID = ?" );
							  
		// extract our values from $_POST
		extract( $_POST );
		
		// get rid of non-digits in our home phone number
		$homephone = preg_replace( '/\D/', '', $homephone );
		
		// bind parameters from our form
		$sql->bind_param( 'sssssssssi', $firstname, $mi, $lastname, $ssn, $address, $zip, $homephone, $dob, $gender, $id );
		
		// execute the query
		$sql->execute();
		
		// redirect back to the list of students page
		header( "Location: /340/index.php" );
	} else {
		// get the id of the student passed in
		$id = $_GET[ 'id' ];
		
		// create a SQL statement
		$sql = "SELECT * FROM students WHERE id = $id";
		
		// execute the query
		$result = $db->query( $sql );
		
		// get the data for this student
		$student = $result->fetch_assoc();
		
		// format the home phone
		$homephone = '(' . substr( $student[ 'homephone' ], 0, 3 ) . ') ' .
					 substr( $student[ 'homephone' ], 3, 3 ) . '-' .
					 substr( $student[ 'homephone' ], 6, 4 );
	}
	
	// get the courses for our courses dropdown
	$sql = "SELECT * FROM courses";
	
	// execute the query
	$courses = $db->query( $sql );
	
	// create the options for our courses dropdown
	$course_opts = '<option value="">Select a course to add...</option>';
	while( $course = $courses->fetch_assoc() ) {
		$course_opts .= '<option value="' . $course[ 'ID' ] . '">' . $course[ 'title' ] . '</option>';
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Update a Student</title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="../js/courses.js"></script>
		</head>
	<body>
		<div id="wrapper">
			<h1>Update a Student</h1>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<input type="hidden" name="id" value="<?php echo $student[ 'ID' ]; ?>" />
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="fn">First Name</label></th>
							<td><input type="text" name="firstname" id="fn" value="<?php echo $student[ 'firstname' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="mi">Middle Initial</label></th>
							<td><input type="text" name="mi" id="mi" value="<?php echo $student[ 'mi' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="ln">Last Name</label></th>
							<td><input type="text" name="lastname" id="ln" value="<?php echo $student[ 'lastname' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="ssn">SSN</label></th>
							<td><input type="text" name="ssn" id="ssn" value="<?php echo $student[ 'ssn' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="address">Address</label></th>
							<td><input type="text" name="address" id="address" value="<?php echo $student[ 'address' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="zip">Zip</label></th>
							<td><input type="text" name="zip" id="zip" value="<?php echo $student[ 'zip' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="homephone">Home Phone</label></th>
							<td><input type="text" name="homephone" id="homephone" value="<?php echo $homephone; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="dob">Date of Birth</label></th>
							<td><input type="date" name="dob" id="dob" value="<?php echo $student[ 'dob' ]; ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="gender">Gender</label></th>
							<td>
								<select name="gender" id="gender">
									<option value="M"<?php echo ( 'M' == $student[ 'gender' ] ) ? ' selected="selected"' : ''; ?>>Male</option>
									<option value="F"<?php echo ( 'F' == $student[ 'gender' ] ) ? ' selected="selected"' : ''; ?>>Female</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" value="Update Student" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>

			<h1>Schedule</h1>
			<table id="schedule">
				<thead>
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Code</th>
						<th scope="col">Difficulty</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<select name="course">
				<?php echo $course_opts; ?>
			</select>
			<button id="addCourse" type="button">Add to Schedule</button>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
		<script src="../js/courses.js" type="text/javascript"></script>
	</body>
</html>