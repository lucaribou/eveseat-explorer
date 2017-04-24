<?php

namespace Seat\Cara\Explorer\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
	protected $table = 'mapDenormalize';
	public $timestamps = false;
	public $primaryKey = "itemID";
	public $incrementing = false;
}