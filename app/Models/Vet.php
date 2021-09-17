<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    use HasFactory;
    
    protected $table = 'veterinarians';

     public function schedule(){
         return $this->hasMany('App\Schedule');
     }
}
