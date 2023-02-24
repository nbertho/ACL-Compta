<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    use HasFactory;

    protected $table = 'session_type';

    protected $fillable = [
        'name',
        'description',
        'length',
        'price',
        'location_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function locations()
    {
        return $this->hasOne(Locations::class, 'id', 'location_id');
    }

}
