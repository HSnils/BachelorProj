@extends('partials.template')

@section('content')

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart" style="width: 450px; height: 250px;"></div>

				<script type="text/javascript">
					new Morris.Donut({
						// ID of the element in which to draw the chart.
						element: 'donutchart',
						// Chart data records -- each entry in this array corresponds to a point on
						// the chart.
						data: [
							{ year: '2008', value: 20 },
							{ year: '2009', value: 10 },
							{ year: '2010', value: 5 },
							{ year: '2011', value: 5 },
							{ year: '2012', value: 20 }
						],
						// The name of the data record attribute that contains x-values.
						xkey: 'year',
						// A list of names of data record attributes that contain y-values.
						ykeys: ['value'],
						// Labels for the ykeys -- will be displayed when you hover over the
						// chart.
						labels: ['Value']
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
							{ year: '2008', value: 20 },
							{ year: '2009', value: 10 },
							{ year: '2010', value: 5 },
							{ year: '2011', value: 5 },
							{ year: '2012', value: 20 }
						],
						// The name of the data record attribute that contains x-values.
						xkey: 'year',
						// A list of names of data record attributes that contain y-values.
						ykeys: ['value'],
						// Labels for the ykeys -- will be displayed when you hover over the
						// chart.
						labels: ['Value']
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
							{ year: '2008', value: 20 },
							{ year: '2009', value: 10 },
							{ year: '2010', value: 5 },
							{ year: '2011', value: 5 },
							{ year: '2012', value: 20 }
						],
						// The name of the data record attribute that contains x-values.
						xkey: 'year',
						// A list of names of data record attributes that contain y-values.
						ykeys: ['value'],
						// Labels for the ykeys -- will be displayed when you hover over the
						// chart.
						labels: ['Value']
					});
				</script>
	
	</div>
</div>
	
@endsection