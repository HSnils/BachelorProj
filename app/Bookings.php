<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{

	/**
     * Any columns inside guarded will not be accepted.
     */
	protected $guarded = [];
	
    /**
     * Defines the eloquent relationship between a item and a user.
     * A item belongs to a user.
     */
    public function user() { 
    	return $this->belongsTo(User::class)->select('id', 'name', 'role');
    }

     /**
     * Defines the eloquent relationship between a item and a category.
     * A item has one category.
     */
    public function category() { 
        return $this->hasOne(Category::class);
    }
	
	public function bookingEquipment() {
		return $this->hasOne(bookings_equipment::class);
		
	}
	
	public function bookingRoom() {
		return $this->hasOne(bookings_room::class);
		
	}
}
