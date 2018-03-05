<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * Any columns inside guarded will not be accepted.
     */
	protected $guarded = [];

    /**
     * Since the pk is not named 'id', we have to specifically define it here to make
     * use of it with eloquent.
     */
	protected $primaryKey = 'roles';
 	public $incrementing = false;

 	public $timestamps = false;
}
