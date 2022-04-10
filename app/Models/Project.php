<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function submissions()
    {
        return $this->hasMany(submission::class);
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}
