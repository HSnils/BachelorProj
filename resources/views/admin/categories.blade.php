@extends('partials.template')

@section('content')
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--4-col-phone">
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect categoriesTabBox">
			<div class="mdl-tabs__tab-bar flex100">
					<a href="#projects-panel" class="mdl-tabs__tab is-active" style="width: 100%;">All Projects</a>
					<a href="#subjects-panel" class="mdl-tabs__tab" style="width: 100%;">All Subjects</a>
					<a href="#other-panel" class="mdl-tabs__tab" style="width: 100%;">Other</a>
			</div>

			<div class="mdl-tabs__panel is-active categoriesTable" id="projects-panel">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--1dp" style="width: 100%;">
					<thead class="">
						<tr class=" ">
							<th class="mdl-data-table__cell--non-numeric">Name</th>
							<th class="mdl-data-table__cell--non-numeric">Edit</th>
						</tr>
					</thead>
					<tbody class="">
						@foreach ($allCategories as $category)
							@if($category->type == "Project")
							<tr class="">
								<td class="mdl-data-table__cell--non-numeric">{{$category->category}}</td>
								<td class="mdl-data-table__cell--non-numeric " >
									<a href="" ><i class="material-icons mdl-button--primary">edit</i></a>
								</td>
							</tr>
							@endif
						@endforeach	
						</button>
					</tbody>
				</table>
				<button class=" mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored addBtn mdl-shadow--2dp">
				<i class="material-icons">add</i>	
			</div>
			<div class="mdl-tabs__panel categoriesTable" id="subjects-panel">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--1dp" style="width: 100%;">
					<thead class="">
						<tr class=" ">
							<th class="mdl-data-table__cell--non-numeric">Name</th>
							<th class="mdl-data-table__cell--non-numeric">Edit</th>
						</tr>
					</thead>
					<tbody class="">
						@foreach ($allCategories as $category)
						@if($category->type == "Subject")
							<tr class="">
								<td class="mdl-data-table__cell--non-numeric">{{$category->category}}</td>
								<td class="mdl-data-table__cell--non-numeric " >
									<a href="" ><i class="material-icons mdl-button--primary">edit</i></a>
								</td>
							</tr>
						@endif
						@endforeach
					</tbody>
				</table>
				<button class=" mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--2dp">
					<i class="material-icons">add</i>
				</button>
			</div>
			<div class="mdl-tabs__panel categoriesTable" id="other-panel">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--1dp" style="width: 100%;">
					<thead class="">
						<tr class=" ">
							<th class="mdl-data-table__cell--non-numeric">Name</th>
							<th class="mdl-data-table__cell--non-numeric">Edit</th>
						</tr>
					</thead>
					<tbody class="">
						@foreach ($allCategories as $category)
						@if($category->type == "Other")
							<tr class="">
								<td class="mdl-data-table__cell--non-numeric">{{$category->category}}</td>
								<td class="mdl-data-table__cell--non-numeric " >
									<a href="" ><i class="material-icons mdl-button--primary">edit</i></a>
								</td>
							</tr>
						@endif
						@endforeach
					</tbody>
				</table>
				<button class=" mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--2dp">
					<i class="material-icons">add</i>
				</button>
			</div>

		</div>
	</div>
</div>


<script>
	$('.knappis').click(function(){
		document.location.href="";

	});
</script>
@endsection