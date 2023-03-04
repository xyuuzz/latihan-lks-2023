<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        "name",
        "minute_length",
        "picture_url"
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
