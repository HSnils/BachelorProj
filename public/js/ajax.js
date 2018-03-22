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
		//clears the old data (to remove old prints)
		$('#equipmentsSection').html('');

		$selectBox = "<span for='equipment_1' class='formPadding'>Select Equipment</span><select name='equipment_1' id='equipment_1' class='formPadding width100 marginTop1'></select>";

		$('#equipmentsSection').append($selectBox);

		//loops through and prints everything
		for(i in $data){
			$equipment = $([

				"<option value='"+$data[i].id+"'>"+$data[i].name+"</option>"	
				].join());
			$('#equipment_1').append($equipment);
		}
	}
});