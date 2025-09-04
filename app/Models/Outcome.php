<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportedError;

class Outcome extends Model
{
    use HasFactory;
        protected $fillable = [
        'outcome', 'user_id'
    ];
    public function reported_err_outcome(){
        return $this->belongsTo(ReportedError::class, 'outcome');
    }
}
