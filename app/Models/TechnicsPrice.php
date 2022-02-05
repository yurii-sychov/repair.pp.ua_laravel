<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicsPrice extends Model
{
	use HasFactory;

	public function technic()
	{
		return $this->belongsTo(Technic::class);
	}
}
