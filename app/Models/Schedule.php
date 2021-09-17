<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    protected $table = 'schedule';


    protected $fillable=['title','start','end'];

    public function vet(){
        return $this->belongsTo('App\Vet','vet_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
