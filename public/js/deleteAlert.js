$(document).ready(function () {

    //Click function to run when any deletebutton was clicked using on(click) with document as deletebuttons in ajax are printed out
	$('.deleteUserButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to delete this user?')) {
			e.preventDefault();
			return false;
		}
	});

	$('.approveBookingButton').click(function(e){
		//if they click cancel, prevents the default behavior and returns false.
		if(!confirm('Are you sure you want to approve this booking?')) {
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

	/*
	
	MDL DIALOG
	 <button id="show-dialog" type="button" class="mdl-button">Show Dialog</button>
	<dialog class="mdl-dialog">
		<h4 class="mdl-dialog__title">Allow data collection?</h4>
		<div class="mdl-dialog__content">
			<p>
			Allowing us to collect data will let us get you the information you want faster.
			</p>
		</div>
		<div class="mdl-dialog__actions">
			<button type="button" class="mdl-button">Agree</button>
			<button type="button" class="mdl-button close">Disagree</button>
		</div>
	</dialog>
	<script>
		var dialog = document.querySelector('dialog');
		var showDialogButton = document.querySelector('#show-dialog');
		if (! dialog.showModal) {
			dialogPolyfill.registerDialog(dialog);
		}
		showDialogButton.addEventListener('click', function() {
			dialog.showModal();
		});
		dialog.querySelector('.close').addEventListener('click', function() {
			dialog.close();
		});
	</script>*/
