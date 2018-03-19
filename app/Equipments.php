<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    public function booking() {
		return $this->hasOne(bookings_equipment::class);
		
	}
}
