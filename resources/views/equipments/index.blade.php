@extends('partials.template')

@section('content')
	<div>
    	EQUIPMENTS 
	</div>

	<table class="mdl-card mdl-shadow--4dp flex100">
		<thead class="width100">
			<tr class="tableRow tableHead">
				<td>ID</td>
				<td>Name</td>
				<td>Type</td>
				<td>Location</td>
				<td>Description</td>
				<td>Lockdown</td>
				<td>Status</td>
				<td>Image</td>
				<td>Created at</td>
				<td>Updated at</td>
			</tr>
		</thead>
		<tbody class="width100">
			@foreach ($allEquipments as $equipment)
			<tr class="tableRow">
				<td >{{$equipment->id}}</td>
				<td >{{$equipment->name}}</td>
				<td >{{$equipment->type}}</td>
				<td >{{$equipment->location}}</td>
				<td >{{$equipment->desc}}</td>
				<td >{{$equipment->lockdown}}</td>
				<td >{{$equipment->status}}</td>
				<td >{{$equipment->image}}</td>
				<td >{{$equipment->created_at}}</td>
				<td >{{$equipment->updated_at}}</td>
			</tr>
			@endforeach
		</tbody>	
	</table>
@endsection