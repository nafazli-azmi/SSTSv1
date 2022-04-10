<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submission extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function progressess()
    {
        return $this->hasMany(Progress::class);
    }

    public function project()
    {
        return $this->belongsTo(User::class);
    }
}
