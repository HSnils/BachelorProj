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
		return $this->belongsTo(Bookings::class, 'id');
		
	}
	
	public function equipment() {
		return $this->belongsTo(Equipments::class, 'id');
		
	}
}
