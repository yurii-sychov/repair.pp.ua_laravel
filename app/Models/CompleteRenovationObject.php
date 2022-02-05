<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteRenovationObject extends Model
{
	use HasFactory;

	public function subdivision()
	{
		return $this->belongsTo(Subdivision::class);
	}

	public function created_user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updated_user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
