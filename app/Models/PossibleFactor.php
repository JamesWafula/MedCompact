<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportedError;

class PossibleFactor extends Model
{
    use HasFactory;
        protected $fillable = [
        'possible_factor', 'user_id'
    ];
    public function reported_err_possible_factor(){
        return $this->belongsTo(ReportedError::class, 'possible_factor_id');
    }
}
