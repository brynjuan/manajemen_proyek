<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'time',
        'location',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'time' => 'datetime',
        ];
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'attendances')->withTimestamps()->withPivot('attended_at');
    }
}
