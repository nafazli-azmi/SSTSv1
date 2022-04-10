<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded=[];

    //many-to-many
    public function students(){
        return $this->belongsToMany(User::class);//where
    }    
    
    public function supervisors(){
        return $this->belongsToMany(User::class);//where
    }
}
