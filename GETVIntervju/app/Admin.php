<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract {

	protected $connection = 'mysql';
	protected $primaryKey = 'id';
	protected $table = 'admins';
	
	use Authenticatable, CanResetPassword;
	protected $fillable = ['name', 'email', 'password'];
}