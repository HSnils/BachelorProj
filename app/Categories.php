<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Any columns inside guarded will not be accepted.
     */
	protected $guarded = [];

    /**
     * Since the pk is not named 'id', we have to specifically define it here to make
     * use of it with eloquent.
     */
	protected $primaryKey = 'category';
 	public $incrementing = false;

 	/**
     * Defines the eloquent relationship between a category and items.
     * One category can have many items.
     */
    public function bookings() {
        return $this->hasMany(Bookings::class, 'category');
    }

    /**
     * Creates a new category with the passed variable.
     * @param array $category An array containing the name of the new category. 
    */
    public function createCategory($category) {
    	Categories::create([
    		'category' => $category['category'],
				'type' => $category['type']
    	]);
    }
	
		public function updateCategory($category, $currentCat){
		
		//session()->flash('notifyUser', $this->id);
		Categories::where('category', $currentCat)
			->update([
				'category' => $category['category'],
				'type' => $category['type']
		]);
	}
}
