<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bookings;
use App\Rooms;

class bookings_room extends Model
{
	protected $guarded = [];
	
	public $timestamps = false;
	
    public function booking() {
		return $this->belongsTo(Bookings::class,'id');
		
	}
	
	public function room() {
		return $this->belongsTo(Rooms::class, 'room_number');
		
	}
	
}
