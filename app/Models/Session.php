<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';

    protected $fillable = [
        'date',
        'patient_id',
        'session_type_id',
        'is_present',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function patients()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function session_type()
    {
        return $this->hasOne(SessionType::class, 'id', 'session_type_id');
    }
}
