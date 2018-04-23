@extends('partials.template')

@section('content')

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart" style="width: 450px; height: 250px;"></div>
@foreach($bookedRooms as $room)
		{{ $room->room_number }}
@endforeach
				<script type="text/javascript">
					new Morris.Donut({
						// ID of the element in which to draw the chart.
						element: 'donutchart',
						// Chart data records -- each entry in this array corresponds to a point on
						// the chart.
						data: [
							{ label: 'A008', value: 1 },
							{ label: 'A008', value: 1 },
							{ label: 'A008', value: 1 },
							{ label: 'A008', value: 1 }

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
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart2" style="width: 450px; height: 250px;"></div>

				<script type="text/javascript">
					new Morris.Donut({
						// ID of the element in which to draw the chart.
						element: 'donutchart2',
						// Chart data records -- each entry in this array corresponds to a point on
						// the chart.
						data: [
							{ label: 'Projects', value: 20 },
							{ label: 'Education', value: 10 },
							{ label: 'Other', value: 5 }
						],
						
						colors: [
							"#6a206c",
							"#852988",
							"#9d539f"
							
						]
					});
				</script>
	
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart3" style="width: 450px; height: 250px;"></div>

				<script type="text/javascript">
					new Morris.Donut({
						// ID of the element in which to draw the chart.
						element: 'donutchart3',
						// Chart data records -- each entry in this array corresponds to a point on
						// the chart.
						data: [
							{ label: 'Student', value: 20 },
							{ label: 'Employee', value: 10 }
						],
						
						colors: [
							"#20246c",
							"#53569f"
							
						]
					});
				</script>
	
	</div>
	<div class="mdl-cell mdl-cell--12-col">
		<div class="mdl-cell mdl-cell--3-col">
			<a href="{{route('logRooms')}}">
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
					Rooms
				</button>
			</a>
			
		</div>
		<div class="mdl-cell mdl-cell--3-col">
			<a href="{{route('logEquipments')}}">
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
					Equipments
				</button>
			</a>
		</div>
		<div class="mdl-cell mdl-cell--3-col">
			<a href="{{route('logUsers')}}">
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
					Users
				</button>
			</a>
		</div>
		<div class="mdl-cell mdl-cell--3-col">
			<a href="{{route('logCategories')}}">
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
					Categories
				</button>
			</a>
		</div>
	</div>
</div>
	
@endsection