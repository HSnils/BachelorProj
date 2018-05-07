<?php

namespace App;
use Carbon\Carbon;
use App\Equipments;

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
	
    /**
     * Defines the eloquent relationship between a item and an equipment.
     * A item has one equipment.
     */
	public function bookingEquipment() {
		return $this->hasOne(bookings_equipment::class, 'bookings_id');
	}
	
    /**
     * Defines the eloquent relationship between a item and a room.
     * A item has one room.
     */
	public function bookingRoom() {
		return $this->hasOne(bookings_room::class, 'bookings_id');
	}

    //gets name of an equipment using the equipment id
    public function getEquipmentName($id)
    {
        $equipmentName = Equipments::select('name')->where('id',$id)->first();

        return $equipmentName->name;
    }

    //gets location of an equipment using the equipment id
    public function getEquipmentLocation($id)
    {
        $equipmentName = Equipments::select('location')->where('id',$id)->first();

        return $equipmentName->location;
    }

    //gets the hours spent on a booking
    public function hoursSpent(){
        $hoursUsed = 0;
        $startDate = new Carbon($this->from_date);
        $endDate = new Carbon ($this->to_date);

        //uses carbon function to find the differnece in minnutes and devides it by 60(minutes to get hours)
        $hoursUsed += $endDate->diffInMinutes($startDate) / 60;
        return $hoursUsed;
    }
}
