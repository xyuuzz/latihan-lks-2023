<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        "name",
        "branch_id",
        "basic_price",
        "additional_friday_price",
        "additional_saturday_price",
        "additional_sunday_price",
    ];

    public function getBasicPriceAttribute() 
    {
        return "Rp. " . number_format($this->attributes["basic_price"], 2);
    }

    public function getAdditionalFridayPriceAttribute() 
    {
        return "Rp. " . number_format($this->attributes["additional_friday_price"], 2);
    }

    public function getAdditionalSaturdayPriceAttribute() 
    {
        return "Rp. " . number_format($this->attributes["additional_saturday_price"], 2);
    }
    
    public function getAdditionalSundayPriceAttribute() 
    {
        return "Rp. " . number_format($this->attributes["additional_sunday_price"], 2);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
