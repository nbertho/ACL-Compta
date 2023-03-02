<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'firstname',
        'lastname',
        'birth_date',
        'description',
        'national_number',
        'phone',
        'address',
        'nationality',
        'languages_spoken_at_home',
        'follow_up_reasons',
        'school',
        'school_year',
        'mutuality',
        'family',
        'medical_background',
        'educational_background',
        'hobbies',
        'contacts'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($patient) {
            $patient->sessions()->delete();
        });
    }

}
