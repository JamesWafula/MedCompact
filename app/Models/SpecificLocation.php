<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Locations;
use App\Models\ReportedError;

class SpecificLocation extends Model
{
    use HasFactory;
        protected $fillable = [
        'specific_location', 'user_id','location_id'
    ];
    // add ralationship to the location
    public function specificLocation()
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }
    public function reported_err_specific_location(){
        return $this->belongsTo(ReportedError::class, 'specific_location_by_user');
    }
}
