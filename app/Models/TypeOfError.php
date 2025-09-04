<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Incident;
use App\Models\ReportedError;

class TypeOfError extends Model
{
    use HasFactory;
        protected $fillable = [
        'type_of_error', 'user_id','incident_id'
    ];

    //eloquent realtionship with incident
    public function typeoferror() 
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }
    public function reported_err_type_of_error(){
        return $this->belongsTo(ReportedError::class, 'type_of_error_id');
    }
}
