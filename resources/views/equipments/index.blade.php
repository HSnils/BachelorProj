@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
    	EQUIPMENTS 
	</div>

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp  ">
		<thead class="">
			<tr class=" ">
				<th class="mdl-data-table__cell--non-numeric">Name</th>
				<th class="mdl-data-table__cell--non-numeric">Type</th>
				<th class="mdl-data-table__cell--non-numeric">Location</th>
				<th class="mdl-data-table__cell--non-numeric">Description</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach ($allEquipments as $equipment)
				<tr class="">
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->name}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->type}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->desc}}</td>
				</tr>
			@endforeach
		</tbody>	
	</table>
@endsection