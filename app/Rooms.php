<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    /**
     * Any columns inside guarded will not be accepted.
     */
	protected $guarded = [];

    /**
     * Since the pk is not named 'id', we have to specifically define it here to make
     * use of it with eloquent.
     */
	protected $primaryKey = 'room_number';
 	public $incrementing = false;

 	public function createRoom($newRoom){
		Rooms::create([
				'room_number' => $newRoom['room_number'],
				'type' => $newRoom['type'],
				'building' => $newRoom['building']
		]);
	}
}
