<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Hello World!</title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>HTTC Students</h1>
			<?php
				// create a connection to our database
				$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
				
				// write a SQL query to get all students
				$sql = "SELECT * FROM students";
				
				// execute the query on the database
				$students = $db->query( $sql );
				
				// check to see if the query returned any rows
				if ( $students->num_rows > 0 ) {
					// yes! it returned rows
					// diplay the results
					?>
					<table>
						<thead>
							<tr>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while ( $student = $students->fetch_assoc() ) {
								echo '<tr>';
								echo '<td>' . $student[ 'firstname' ] . '</td><td>' . $student[ 'lastname' ] . '</td>';
								echo '<td>';
								echo '<a href="details.php?id=' . $student[ 'ID' ] . '">Details</a> ';
								echo '<a href="edit.php?id=' . $student[ 'ID' ] . '">Edit</a> ';
								echo '<a onclick="return confirm( \'Are you sure?\' );" href="delete.php?id=' . $student[ 'ID' ] . '">Delete</a>';
								echo '</td>';
								echo '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php
				} else {
					// nope, there were no students in the DB
					echo '<p>No students.</p>';
				}
			?>
			<p>
				<a class="button" href="new.php">Add a Student</a>
			</p>
		</div>
	</body>
</html>