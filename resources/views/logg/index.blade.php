@extends('partials.template')

@section('content')

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart" style="width: 450px; height: 250px;"></div>

		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Task', 'Hours per Day'],
							['Work',     11],
							['Eat',      2],
							['Commute',  2],
							['Watch TV', 2],
							['Sleep',    7]
						]);

						var options = {
							title: 'My Daily Activities',
							pieHole: 0.4,
						};

						var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
						chart.draw(data, options);
					}
				</script>
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart2" style="width: 450px; height: 250px;"></div>

		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Task', 'Hours per Day'],
							['Work',     11],
							['Eat',      2],
							['Commute',  2],
							['Watch TV', 2],
							['Sleep',    7]
						]);

						var options = {
							title: 'My Daily Activities',
							pieHole: 0.4,
						};

						var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
						chart.draw(data, options);
					}
				</script>
	
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<div id="donutchart3" style="width: 450px; height: 250px;"></div>

		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">
					google.charts.load("current", {packages:["corechart"]});
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
						var data = google.visualization.arrayToDataTable([
							['Task', 'Hours per Day'],
							['Work',     11],
							['Eat',      2],
							['Commute',  2],
							['Watch TV', 2],
							['Sleep',    7]
						]);

						var options = {
							title: 'My Daily Activities',
							pieHole: 0.4,
						};

						var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
						chart.draw(data, options);
					}
				</script>
	
	</div>
</div>
	
@endsection