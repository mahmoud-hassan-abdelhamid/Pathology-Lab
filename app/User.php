<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

 	protected $fillable = ['name','email','password','type','roles'];

    public function addRecord($email, $name,  $password, $type)
    {
        return $this->fill([
            "email" => $email,
            "name" => $name,
            'password' => bcrypt($password),
            'type' => $type,
        ]);
    }

    public function type()
    {
    	return $this->type;
    }
    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
