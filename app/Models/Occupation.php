<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportedError;

class Occupation extends Model
{
    use HasFactory;
        protected $fillable = [
        'occupation', 'user_id'
    ];
    public function reported_err_occupation(){
        return $this->belongsTo(ReportedError::class, 'occupation_id');
    }
}
