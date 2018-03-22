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

		//loops through and prints everything
		for(i in $data){
			$equipment = $([
				"<li class='mdl-list__item'><span class='mdl-list__item-primary-content'>"+$data[i].name+"</span></li>"	
				].join());
			$('#equipmentsSection').append($equipment);
		}
	}
});