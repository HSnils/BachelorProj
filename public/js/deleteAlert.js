$(document).ready(function () {

    //Click function to run when any deletebutton was clicked using on(click) with document as deletebuttons in ajax are printed out
	$(document).on('click', '.deleteButton', function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to delete this?')) {
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
});