@extends('partials.template')
@section('content')

<div>Room <b>{{$topRoomThisMonth[0]->room_number}}</b> was used {{$hoursTopRoom}} hours in the past month<span>

</span></div>
<div id="donutchart" style="width: 450px; height: 250px;"></div>
	<script type="text/javascript">
		new Morris.Donut({
			// ID of the element in which to draw the chart.
			element: 'donutchart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [
				@foreach($topRoomsThisMonth as $room)
				{ label: '{{$room->room_number}}', value: '{{$room->count}}' },
				@endforeach
			],
			
			colors: [ 
				"#552988",
				"#663E93",
				"#76539F",
				"#8869AB",
				"#997EB7",
				"#AA94C3",
				"#BBA9CF",
				"#CCBEDB"
			]
		
		});
	</script>
	

@endsection