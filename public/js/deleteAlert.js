$(document).ready(function () {

    //Click function to run when any deletebutton was clicked using on(click) with document as deletebuttons in ajax are printed out
	$('.deleteUserButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to delete this user?')) {
			e.preventDefault();
			return false;
		}
	});

	$('.deleteBookingButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to delete this booking?')) {
			e.preventDefault();
			return false;
		}
	});

	$('.closeButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to close this?')) {
			e.preventDefault();
			return false;
		}
	});

	$('.approveButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to approve this user?')) {
			e.preventDefault();
			return false;
		}
	});

	$('.editButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to edit this user?')) {
			e.preventDefault();
			return false;
		}
	});
});