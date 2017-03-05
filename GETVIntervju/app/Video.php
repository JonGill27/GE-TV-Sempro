<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $connection = 'mysql';
	protected $primaryKey = 'id';
	protected $table = 'videos';
	
	protected $fillable = array(
		'name',
		'description',
		'url',
		'category',
		'year'
		);
}
