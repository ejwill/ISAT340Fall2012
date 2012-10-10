<?php
	// check to see if we're coming to this page after having
	// submitted the form
	if ( isset( $_POST[ 'firstname' ] ) ) {
	
		// we have values, let's try to insert new student into the db
		// connect
		$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
		
		// create a SQL statement
		$sql = $db->prepare(
			"INSERT INTO students (firstname,mi,lastname,ssn,address,zip,homephone,dob,gender) 
			 VALUES (?,?,?,?,?,?,?,?,?)");
		
		// extract our values from $_POST
		extract( $_POST );
		
		// get rid of non-digits in our home phone number
		$homephone = preg_replace( '/\D/', '', $homephone );
		
		// bind parameters from our form
		$sql->bind_param( 'sssssssss', $firstname, $mi, $lastname, $ssn, $address, $zip, $homephone, $dob, $gender );
		
		// execute the query
		$sql->execute();
		
		// redirect back to the list of students page
		header( "Location: /340/index.php" );
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Add a Student</title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Add a New Student</h1>
			<form method="post" action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="fn">First Name</label></th>
							<td><input type="text" name="firstname" id="fn" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="mi">Middle Initial</label></th>
							<td><input type="text" name="mi" id="mi" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="ln">Last Name</label></th>
							<td><input type="text" name="lastname" id="ln" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="ssn">SSN</label></th>
							<td><input type="text" name="ssn" id="ssn" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="address">Address</label></th>
							<td><input type="text" name="address" id="address" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="zip">Zip</label></th>
							<td><input type="text" name="zip" id="zip" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="homephone">Home Phone</label></th>
							<td><input type="text" name="homephone" id="homephone" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="dob">Date of Birth</label></th>
							<td><input type="date" name="dob" id="dob" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="gender">Gender</label></th>
							<td>
								<select name="gender" id="gender">
									<option value="M">Male</option>
									<option value="F">Female</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="submit" value="Add Student" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</body>
</html>