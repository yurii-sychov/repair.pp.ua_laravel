<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
	use HasFactory;

	public function created_user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updated_user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
