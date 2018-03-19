<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bookings_equipment extends Model
{
    protected $guarded = [];
	
	public function booking() {
		return $this->hasOne(Bookings::class);
		
	}
	
	public function equipment() {
		return $this->hasMany(Equipments::class, 'equipment_id');
		
	}
}
