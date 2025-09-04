<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportedError;

class Preventability extends Model
{
    use HasFactory;
        protected $fillable = [
        'preventability', 'user_id'
    ];
    public function reported_err_preventability(){
        return $this->belongsTo(ReportedError::class, 'preventability_id');
    }
}
