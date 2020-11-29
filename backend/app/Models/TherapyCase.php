<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapyCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'finished',
        'diagnosis'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
