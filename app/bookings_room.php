<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bookings_room extends Model
{
	protected $guarded = [];
	
    public function booking() {
		return $this->hasMany(Bookings::class, 'id');
		
	}
	
	public function room() {
		return $this->hasOne(Rooms::class, 'room_number');
		
	}
}
