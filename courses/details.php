<?php
	// connect to the DB
	$db = new mysqli( 'localhost', 'httc', 'httc_letmein1', 'httc' );
	
	// get the id of the course passed in
	$id = $_GET[ 'id' ];
	
	// create a SQL statement
	$sql = "SELECT * FROM courses WHERE id = $id";
	
	// execute the query
	$result = $db->query( $sql );
	
	// get the data for this course
	$course = $result->fetch_assoc();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Details for <?php echo $course[ 'title' ]; ?></title>
		<link rel="stylesheet" media="screen" href="../css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<h1>Details for <?php echo $course[ 'title' ]; ?></h1>
			<table>
				<tbody>
					<tr>
						<th scope="row"><label for="title">Title</label></th>
						<td><?php echo $course[ 'title' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="code">Code</label></th>
						<td><?php echo $course[ 'code' ]; ?></td>
					</tr>
					<tr>
						<th scope="row"><label for="ln">Difficulty</label></th>
						<td><?php echo $course[ 'difficulty' ]; ?></td>
					</tr>
				</tbody>
			</table>
			<p>
				<a class="button" href='/340/courses/index.php'>Back to Course Listing</a>
			</p>
		</div>
	</body>
</html>