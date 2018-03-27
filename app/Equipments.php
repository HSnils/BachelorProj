<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\bookings_equipment;

class Equipments extends Model
{
    public function booking() {
		return $this->hasMany('App\bookings_equipment', 'equipment_id');
		
	}

	protected $fillable = [
		'name', 'type', 'location', 'desc', 'lockdown', 'other_documentation', 'ntnu_id'
	];

	public function createEquipment($equipment){

		if($equipment['other_documentation'] == ''){
			$otherDocumentation = 'No documentation.';
		}else{
			$otherDocumentation = $equipment['other_documentation'];
		}

		Equipments::create([
				'name' => $equipment['name'],
				'type' => $equipment['type'],
				'location' => $equipment['location'],
				'desc' => $equipment['desc'],
				'lockdown' => $equipment['lockdown'],
				'other_documentation' => $otherDocumentation
		]);
	}

	public function updateEquipment($equipment,$id){
		if($equipment['other_documentation'] == ''){
			$otherDocumentation = 'No documentation.';
		}else{
			$otherDocumentation = $equipment['other_documentation'];
		}
		//session()->flash('notifyUser', $this->id);
		Equipments::where('id', $id)
			->update([
				'name' => $equipment['name'],
				'type' => $equipment['type'],
				'location' => $equipment['location'],
				'desc' => $equipment['desc'],
				'lockdown' => $equipment['lockdown'],
				'other_documentation' => $otherDocumentation
		]);
	}
}
