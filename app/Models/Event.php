<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = [
        'title', 'location', 'date', 'time'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

     public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('d M, Y');
    }

    public function getFormattedTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->time)->format('gA');
    }
}