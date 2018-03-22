$(document).ready(function () {
	$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

	$('#room_numberBooking').click(function(e){
		e.preventDefault();
		$room = $(this).val();

		$.get("home/" + $room, displayRoomEquipment);
	});

	// Prints the fetched data (from database) to the user.
	function displayRoomEquipment(data, status, xhr) {
		//Parse data and clear the html div container.
		$data = JSON.parse(data);

		$('#equipmentsSection').html('');

		for(i in $data){
			$equipment = $([
				"<li class='mdl-list__item'><span class='mdl-list__item-primary-content'>"+$data[i].name+"</span></li>"
				
				].join());
			$('#equipmentsSection').append($equipment);
		}
	}
});