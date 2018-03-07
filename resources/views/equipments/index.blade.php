@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600">
    	EQUIPMENTS 
	</div>

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp flex100">
		<thead class="">
			<tr class=" ">
				<td>ID</td>
				<td class="mdl-data-table__cell--non-numeric">Name</td>
				<td class="mdl-data-table__cell--non-numeric">Type</td>
				<td class="mdl-data-table__cell--non-numeric">Location</td>
				<td class="mdl-data-table__cell--non-numeric">Description</td>
				<td>Lockdown</td>
				<td>Status</td>
				<td class="mdl-data-table__cell--non-numeric">Image</td>
				<td class="mdl-data-table__cell--non-numeric">Created</td>
				<td class="mdl-data-table__cell--non-numeric">Updated</td>
			</tr>
		</thead>
		<tbody class="">
			@foreach ($allEquipments as $equipment)
				<tr class="">
					<td >{{$equipment->id}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->name}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->type}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->desc}}</td>
					<td >{{$equipment->lockdown}}</td>
					<td >{{$equipment->status}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->image}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->created_at->diffForHumans()}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$equipment->updated_at->diffForHumans()}}</td>
				</tr>
			@endforeach
		</tbody>	
	</table>
@endsection