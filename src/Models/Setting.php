<?php

namespace Seat\Cara\Explorer\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'explorer_settings';
	protected $fillable = [
		'client_id',
		'secret_key'
	];

	public $timestamps = false;
}