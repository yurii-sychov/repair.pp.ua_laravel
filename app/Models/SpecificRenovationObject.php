<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificRenovationObject extends Model
{
	use HasFactory;

	public function subdivision()
	{
		return $this->belongsTo(Subdivision::class);
	}

	public function complete_renovation_object()
	{
		return $this->belongsTo(CompleteRenovationObject::class);
	}

	public function equipment()
	{
		return $this->belongsTo(Equipment::class);
	}
}
