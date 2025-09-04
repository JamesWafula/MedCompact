<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecificLocation;
use App\Models\ReportedError;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = [
        'location', 'user_id'
    ];
    
    protected $table = 'locations'; 
    //eloquent realtionship with specfic location. one location has many specific locations
    public function location()
    {
        return $this->hasMany(SpecificLocation::class);
    }
    public function reported_err_location(){
        return $this->belongsTo(ReportedError::class, 'location_of_error_id');
    }
}
