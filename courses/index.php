<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Hello World!</title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>HTTC Courses</h1>
			<?php
				// create a connection to our database
				$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
				
				// write a SQL query to get all courses
				$sql = "SELECT * FROM courses";
				
				// execute the query on the database
				$courses = $db->query( $sql );
				
				// check to see if the query returned any rows
				if ( $courses->num_rows > 0 ) {
					// yes! it returned rows
					// diplay the results
					?>
					<table>
						<thead>
							<tr>
								<th scope="col">Title</th>
								<th scope="col">Code</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while ( $course = $courses->fetch_assoc() ) {
								echo '<tr>';
								echo '<td>' . $course[ 'title' ] . '</td><td>' . $course[ 'code' ] . '</td>';
								echo '<td>';
								echo '<a href="details.php?id=' . $course[ 'ID' ] . '">Details</a> ';
								echo '<a href="edit.php?id=' . $course[ 'ID' ] . '">Edit</a> ';
								echo '<a onclick="return confirm( \'Are you sure?\' );" href="delete.php?id=' . $course[ 'ID' ] . '">Delete</a>';
								echo '</td>';
								echo '</tr>';
							}
						?>
						</tbody>
					</table>
					<?php
				} else {
					// nope, there were no courses in the DB
					echo '<p>No courses.</p>';
				}
			?>
			<p>
				<a class="button" href="new.php">Add a Course</a>
			</p>
		</div>
	</body>
</html>