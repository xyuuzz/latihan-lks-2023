<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    protected $fillable = [
        'movie_id',
        'studio_id',
        'start',
        'end',
        'price',
    ];

    public function getStartAttribute()
    {
        return Carbon::parse($this->attributes['start'])->format('d M Y H:i');
    }

    public function getEndAttribute()
    {
        return Carbon::parse($this->attributes['end'])->format('d M Y H:i');
    }

    public function getPriceAttribute() 
    {
        return "Rp. " . number_format($this->attributes["price"], 2);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
    
    public function getFillable()
    {
        return $this->fillable;
    }
}
