<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bookings_equipment extends Model
{
    protected $guarded = [];
	
	public function booking() {
		return $this->belongsTo(Bookings::class, 'id');
		
	}
	
	public function equipment() {
		return $this->belongsTo(Equipments::class, 'equipment_id');
		
	}
}
