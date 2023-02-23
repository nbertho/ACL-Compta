<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    use HasFactory;

    protected $table = 'session_type';

    public function locations()
    {
        return $this->hasOne(Locations::class, 'id', 'location_id');
    }

}
