@extends('partials.template')

@section('content')

<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers marginB">
	DASHBOARD
</div>
<div class="">
	<div class="mdl-typography--headline mdl-color-text--grey-600 flex100">
	New users
    </div>
	@include('admin.newUsersTable')
</div>

<div class="marginL">
    <div class="mdl-typography--headline mdl-color-text--grey-600 flex100">
	New student bookings
    </div>
	@include('admin.newBookingsTable')
</div>


<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col"><h4>Booking stats <span>(all time)</span>: </h4> </div>
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart" style="width: 450px; height: 250px;"></div>
		<script type="text/javascript">
			new Morris.Donut({
				// ID of the element in which to draw the chart.
				element: 'donutchart',
				// Chart data records -- each entry in this array corresponds to a point on
				// the chart.
				data: [
					@foreach($totalBookingsByRoom as $room)
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
		<div id="donutchart" style="width: 450px; height: 250px;"></div>
		<script type="text/javascript">
			new Morris.Donut({
				// ID of the element in which to draw the chart.
				element: 'donutchart',
				// Chart data records -- each entry in this array corresponds to a point on
				// the chart.
				data: [
					@foreach($totalBookingsByType as $booking)
					{ label: '{{$booking->type}}', value: '{{$booking->count}}' },
					@endforeach
				],
				
				colors: [
							"#20246c",
							"#53569f"
							
						]
			
			});
		</script>
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart" style="width: 450px; height: 250px;"></div>
		<script type="text/javascript">
			new Morris.Donut({
				// ID of the element in which to draw the chart.
				element: 'donutchart',
				// Chart data records -- each entry in this array corresponds to a point on
				// the chart.
				data: [
					@foreach($totalBookingsByCategoryType as $category)
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
</div>
	


@endsection