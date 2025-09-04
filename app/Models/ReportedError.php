<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Locations;
use App\Models\SpecificLocation;
use App\Models\Incident;
use App\Models\TypeOfError;
use App\Models\Occupation;
use App\Models\Preventability;
use App\Models\Outcome;
use App\Models\PossibleFactor;
use App\Models\User;
use App\Models\ReportedError;

class ReportedError extends Model
{
    use HasFactory;
        protected $fillable = [
            'ip', 
            'email', 
            'gender', 
            'date', 
            'time', 
            'age',
            'location_of_error_id',
            'diagnosis',
            'incident_id',
            'type_of_error_id',
            'possible_factor_id',
            'specific_location_id',
            'specific_location_by_user',
            'preventability_id',
            'suggestions',
            'outcome_id',
            'occupation_id'
        ];

    //eloquent realtionship with all the other fields
    public function location(){
        return $this->hasMany(Locations::class);
    }
    public function specificlocation(){
        return $this->hasMany(SpecificLocation::class);
    }
    public function incident(){
        return $this->hasMany(Incident::class);
    }
    public function typeoferror(){
        return $this->hasMany(TypeOfError::class);
    }
    public function occupation(){
        return $this->hasMany(Occupation::class);
    }
    public function preventability(){
        return $this->hasMany(Preventability::class);
    }
    public function outcome(){
        return $this->hasMany(Outcome::class);
    }
    public function possiblefactor(){
        return $this->hasMany(PossibleFactor::class);
    }
    // public function user(){
    //     return $this->hasMany(User::class);
    // }
    public function reported_err_user(){
        return $this->belongsTo(ReportedError::class, 'user_id', 'id');
    }
}
