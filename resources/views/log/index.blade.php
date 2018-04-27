@extends('partials.template')

@section('content')

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col"><div class="mdl-typography--display-1 mdl-color-text--grey-600 flex100 page-content">
		Bookings this past month
	</div>></div>
	<div class="mdl-cell mdl-cell--4-col">
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
							@foreach($categoryThisMonth as $category)
							{ label: '{{$category->type}}', value: '{{$category->count}}' },
							@endforeach
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
							@foreach($bookingsFromRolesThisMonth as $role)
							{ label: '{{$role->role}}', value: '{{$role->count}}' },
							@endforeach
						],
						
						colors: [
							"#20246c",
							"#53569f"
							
						]
					});
				</script>
	
	</div>

	<div class="mdl-cell mdl-cell--12-col">
		<div class=" flex100 page-content">
			Total hours spent this month: <b>{{$totalHoursSpentThisMonth}}</b>
		</div>
	</div>

    <div class="mdl-cell mdl-cell--12-col">
		<div class="mdl-typography--display-1 mdl-color-text--grey-600 flex100 page-content">
			Specific logs
		</div>
	</div>
	<div class="mdl-cell mdl-cell--12-col page-content">
		<a href="{{route('logRooms')}}">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect marginR">
				Rooms
			</button>
		</a>
		<a href="{{route('logEquipments')}}">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect marginR">
				Equipments
			</button>
		</a>
		<a href="{{route('logUsers')}}">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect marginR">
				Users
			</button>
		</a>
		<a href="{{route('logCategories')}}">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect ">
				Categories
			</button>
		</a>
	</div>
</div>
	
@endsection