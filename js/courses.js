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
					console.log( res );
				}
			});
		}
	});
	
	
});