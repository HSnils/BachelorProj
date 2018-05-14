<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bookings;
use App\Equipments;

class bookings_equipment extends Model
{
    protected $guarded = [];
	
	public $timestamps = false;
	
	public function booking() {
		return $this->belongsTo('App\Bookings','id');
		
	}
	
	public function equipment() {
		return $this->belongsTo('App\Equipments', 'id', 'equipment_id');
		
	}
}
