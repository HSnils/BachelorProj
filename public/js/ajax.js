$(document).ready(function () {
	$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

	$('#room_numberBooking').click(function(e){
		e.preventDefault();

		//gets the value of the selected item
		$room = $(this).val();
		
		$.get("home/" + $room, displayRoomEquipment);
	});

	// Prints the fetched data (from database) to the user.
	function displayRoomEquipment(data, status, xhr) {
		//Parse data 
		$data = JSON.parse(data);

		//shows hidden divs
		$('#roomPrivacy').prop('hidden', false);
		$('#bookingUseage').prop('hidden', false);
		
		//clears the old data (to remove old prints)
		$('#equipmentsSection').html('');

		/*$selectBox = "<span for='equipment_1' class='formPadding'>Select Equipment</span><select name='equipment_1' id='equipment_1' class='formPadding width100 marginTop1'></select>";

		$('#equipmentsSection').append($selectBox);*/
		$('#equipmentsSection').append('<span class="materialLabel marginTop1 marginBottom1">Choose equpment/s</span>');
		//loops through and prints everything
		for(i in $data){
			$equipment = $([

				'<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="equipment-'+$data[i].id+'"><input type="checkbox" id="equipment-'+$data[i].id+'" name="selectedEquipments[]" value="'+$data[i].id+'"class="mdl-checkbox__input"><span class="mdl-checkbox__label">'+$data[i].name+'</span></label>'	
				].join());
			$('#equipmentsSection').append($equipment);
		}

		$('#bookingButton').prop('disabled', false);
		componentHandler.upgradeAllRegistered();
	}

	$('#useageSelect').click(function(e){
		e.preventDefault();

		//gets the value of the selected item
		$selectedUsage = $(this).val();
		
		$.get("home/useage/" + $selectedUsage, displaySpesificUsageChoices);
	});

	// Prints the fetched data (from database) to the user.
	function displaySpesificUsageChoices(data, status, xhr) {
		//Parse data 
		$data = JSON.parse(data);
		console.log($data);
		//clears the old data (to remove old prints)
		$('#spesificUseageSelect').html('');

		//enables spesific usage select
		//$('#spesificUseageSelect').prop('disabled', false);
		$('#spesificUseageSelect').append('<option disabled selected>Choose useage</option>');
		//loops through and prints everything
		for(i in $data){
			$choices = $([

				'<option value="'+$data[i].category+'">'+$data[i].category+'</option>'	
				].join());

			$('#spesificUseageSelect').append($choices);
		}

		componentHandler.upgradeAllRegistered();
	}
});