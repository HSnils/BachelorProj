<?php

namespace App;

use Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'card_id', 
    ];

    /**
     * Defines the eloquent relationship between a user and items.
     * A user can have many items.
     */
    public function bookings() {
        return $this->hasMany(Bookings::class);
    }

    /**
     * Updates a users' username.
     * @param array $user An array containing information about the specified user. 
     */
    public function updateUsername($user){
        User::where('id', $this->id)
            ->update([
                'name' => $user['username'],
                'updated_by' => $user['username']
        ]);
    }

     /**
     * [updatePassword updates password for the user and hashes it]
     * @param  [int] $user [gets it from url with wildcard]
     * @return [updated password]
     */

    /**
     * Updates a users' password after hashing it.
     * @param array $user An array containing information about a specified user. 
     */
    public function updatePassword($user){
        User::where('id', $this->id)
            ->update([
                'password' => bcrypt($user['password']),
                'updated_by' => $this->name
        ]);
    }
    /**
     * [approveUser description]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function approveUser($user){
        User::where('id', $this->id)
            ->update([
                'role' => $user['role']
            ]);
    }

	
	public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function deleteUser($user){
        User::where('id', $this->id)
            ->update([
                'status' => "Deleted",
                'deleted_at' => now(),
                'deleted_by' => Auth::user()->name
        ]);
    }
}
