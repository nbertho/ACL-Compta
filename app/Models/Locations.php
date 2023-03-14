<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locations extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function sessionType(): HasMany
    {
        return $this->hasMany(SessionType::class, 'location_id');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function ($location) {
            $location->sessionType()->delete();
        });
    }

}
