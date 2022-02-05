<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cipher extends Model
{
    use HasFactory;

    public function type_service()
    {
        return $this->belongsTo(TypeService::class);
    }
}
