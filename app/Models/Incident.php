<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeOfError;
use App\Models\ReportedError;

class Incident extends Model
{
    use HasFactory;
    protected $fillable = [
        'incident', 'user_id'
    ];

    //eloquent realtionship with type of error
    public function incident()
    {
        return $this->hasMany(TypeOfError::class);
    }
    public function reported_err_incident(){
        return $this->belongsTo(ReportedError::class, 'incident_id');
    }
}
