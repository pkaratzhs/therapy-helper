<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    public function goals()
    {
        return $this->belongsToMany(Goal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function path()
    {
        return 'api/activities/'.$this->id;
    }
    public function nestedPath(Goal $goal)
    {
        return $goal->path().'/activities/'.$this->id;
    }
}
