jQuery( document ).ready( function( $ ) {
	// we can use $() inside here instead of jQuery()
	
	
	$( '#addCourse' ).click( function() {
		// figure out which course was selected from the dropdown
		var cid = $( '#courseToAdd' ).val();
		console.log( "courseID: " + cid );
		// figure out what student we're adding the course to
		var sid = $( 'input[name="id"]' ).val();
		console.log( "studentID: " + sid );
		// check to make sure that they actually selected a course
		if ( '' == cid ) {
			// alert them to that fact
			alert( "Please select a course first." );
			$( '#courseToAdd' ).attr( 'style', 'background-color:orange;' );
		} else {
			// send a message to the server to add the course
			$.ajax({
				url: 'enroll.php',
				type: 'POST',
				data: {
					studentID: sid,
					courseID:  cid
				},
				success: function ( res ) {
					var newrow = '<tr><th scope="row">' + res.title + '</th>' +
									  '<td>' + res.code + '</td>' +
									  '<td>' + res.difficulty + '</td>' +
									  '<td>&nbsp;</td>';
					$( '#schedule tbody' ).append( newrow );
				}
			});
		}
	});
	
	$( '.removeCourse' ).click( function() {
		// get the id of the student
		var sid = $( 'input[name="id"]' ).val();
		// get the id of the course
		var cid = $( this ).val();
		// send a request to the server to remove the course
		$.post(
			'unenroll.php',
			{
				'studentID' : sid,
				'courseID'  : cid
			},
			function( res ) {
				if ( 1 == res.success ) {
					$( 'button[value="' + cid + '"]' ).closest( 'tr' ).remove();
				} else {
					alert( res.message );
				}
			}
		);
	});
	
});