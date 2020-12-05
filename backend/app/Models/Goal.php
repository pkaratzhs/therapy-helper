<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function therapyCase()
    {
        return $this->belongsTo(TherapyCase::class);
    }
    
    public function path()
    {
    }
}
