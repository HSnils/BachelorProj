@extends('partials.template')

@section('content')
	
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
    	EQUIPMENT 
	</div>

	<div class="relative">
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
			<thead class="">
				<tr class=" ">
					<th class="mdl-data-table__cell--non-numeric">Name</th>
					<th class="mdl-data-table__cell--non-numeric">Type</th>
					<th class="mdl-data-table__cell--non-numeric">Location</th>
					<th class="mdl-data-table__cell--non-numeric">Description</th>
					<th>NTNU ID </th>
					<th>Lockdown</th>
					<th>Status</th>
					<th class="mdl-data-table__cell--non-numeric">Created</th>
					<th class="mdl-data-table__cell--non-numeric">Updated</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($allEquipments as $equipment)
					<tr class="">
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->desc}}</td>
						<td>{{ $equipment->ntnu_id }}</td>
						<td >{{$equipment->lockdown}}</td>
						<td >{{$equipment->status}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->created_at->diffForHumans()}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->updated_at->diffForHumans()}}</td>
						<td class="mdl-data-table__cell--non-numeric " >
							<a href="{{ url('admin/equipments/edit') }}/{{$equipment->id}}" ><i class="material-icons mdl-button--primary">edit</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>	
		</table>
		<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored knappis mdl-shadow--2dp">
			<i class="material-icons">add</i>
		</button>
	</div>
	
	<script>
		$('.knappis').click(function(){
			document.location.href="{{route('newEquipment')}}";
			
		});
	</script>
@endsection