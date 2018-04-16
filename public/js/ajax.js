$(document).ready(function () {
	$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

	$('#room_numberBooking').change(function(e){
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
		$('#dateTimeBox').prop('hidden', false);
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

	$('#useageSelect').change(function(e){
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

	$('#dateFrom').change(function(e){
		e.preventDefault();

		$room = $('#room_numberBooking').val();
		//gets the value of the selected item
		$dateFrom = $(this).val();
		$timeFrom = $('#timeFrom').val();
		$dateTo = $('#dateTo').val();
		$timeTo = $('#timeTo').val();
		
		$.get("home/"+ $room +"/" + $dateFrom + "/"+$timeFrom+"/"+$dateTo+"/"+$timeTo, showAvalibleRooms);
	});

	$('#timeFrom').change(function(e){
		e.preventDefault();

		$room = $('#room_numberBooking').val();

		//gets the value of the selected item
		$dateFrom = $('#dateFrom').val();
		$timeFrom = $(this).val();
		$dateTo = $('#dateTo').val();
		$timeTo = $('#timeTo').val();
		
		$.get("home/"+ $room +"/" + $dateFrom + "/"+$timeFrom+"/"+$dateTo+"/"+$timeTo, showAvalibleRooms);
	});

	$('#dateTo').change(function(e){
		e.preventDefault();

		$room = $('#room_numberBooking').val();

		//gets the value of the selected item
		$dateFrom = $('#dateFrom').val();
		$timeFrom = $('#timeFrom').val();
		$dateTo = $(this).val();
		$timeTo = $('#timeTo').val();
		
		$.get("home/"+ $room +"/" + $dateFrom + "/"+$timeFrom+"/"+$dateTo+"/"+$timeTo, showAvalibleRooms);
	});

	$('#timeTo').change(function(e){
		e.preventDefault();

		$room = $('#room_numberBooking').val();

		//gets the value of the selected item
		$dateFrom = $('#dateFrom').val();
		$timeFrom = $('#timeFrom').val();
		$dateTo = $('#dateTo').val();
		$timeTo = $(this).val();
		
		$.get("home/"+ $room +"/" + $dateFrom + "/"+$timeFrom+"/"+$dateTo+"/"+$timeTo, showAvalibleRooms);
	});

	// Prints the fetched data (from database) to the user.
	function showAvalibleRooms(data, status, xhr) {
		//Parse data 
		$data = JSON.parse(data);
		$numberFound = $data.length;
		$('#otherBookTableDiv').prop('hidden', true);
		console.log($data);
		//clears the old data (to remove old prints)
		$('#otherBookingsTBody').html('');
		$('#numberFound').html('');
		if($numberFound == 0){
			$('#numberFound').append(
				'<div>You can book at this time!</div>'
				);
		}else{
			$('#otherBookTableDiv').prop('hidden', false);
			$('#numberFound').append('<div>Found <b>'+$numberFound+'</b> exsisting booking/s within your selected booking-time</div>');
			
			//loops through and prints everything
			for(i in $data){
				$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				var dateFrom = new Date($data[i].from_date);
				$fromD = dateFrom.getDate();
				$fromM = dateFrom.getMonth();

				$fromY = dateFrom.getFullYear();
				$fromHour = dateFrom.getHours();
				$fromMin = dateFrom.getMinutes();

				$dateTo = new Date($data[i].to_date);
				$toD = $dateTo.getDate();
				$toM = $dateTo.getMonth();

				$toY = $dateTo.getFullYear();
				$toHour = $dateTo.getHours();
				$toMin = $dateTo.getMinutes();

				function addZeroes(number){
					if(number < 10){
						return '0'+number;
					} else {
						return number;
					}
				}

				$rows = $([

					'<tr><td>'+$fromD+'/'+$months[$fromM]+'/'+$fromY+' '+addZeroes($fromHour)+':'+addZeroes($fromMin)+'</td><td>'+$toD+'/'+$months[$toM]+'/'+$toY+' '+addZeroes($toHour)+':'+addZeroes($toMin)+'</td></tr>'	
					].join());

				$('#otherBookingsTBody').append($rows);
			}
		}
	}
});