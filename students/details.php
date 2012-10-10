<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
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
	
	// format the DOB
	$dob = date( 'n/j/y', strtotime( $student[ 'dob' ] ) );
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Details for <?php echo $student[ 'firstname' ] . ' ' .$student[ 'lastname' ]; ?></title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Details for <?php echo $student[ 'firstname' ] . ' ' .$student[ 'lastname' ]; ?></h1>
			<table>
				<tbody>
					<tr>
						<th scope="row"><label for="fn">First Name</label></th>
						<td><?php echo $student[ 'firstname' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="mi">Middle Initial</label></th>
						<td><?php echo $student[ 'mi' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="ln">Last Name</label></th>
						<td><?php echo $student[ 'lastname' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="ssn">SSN</label></th>
						<td><?php echo $student[ 'ssn' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="address">Address</label></th>
						<td><?php echo $student[ 'address' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="zip">Zip</label></th>
						<td><?php echo $student[ 'zip' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="homephone">Home Phone</label></th>
						<td><?php echo $homephone; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="dob">Date of Birth</label></th>
						<td><?php echo $dob; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="gender">Gender</label></th>
						<td><?php
							if ( 'M' == $student[ 'gender' ] ) {
								echo 'Male';
							} else {
								echo 'Female';
							}?>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<a class="button" href='/340/index.php'>Back to Student Listing</a>
			</p>
		</div>
	</body>
</html>