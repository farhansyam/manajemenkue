<?php

namespace App\Models;

use App\Models\Cookie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $table = 'historys';
    protected $guarded = [];
    use HasFactory;


    public function cookie()
    {
        return $this->hasOne(Cookie::class,'id','id_kue');
    }

         public function who()
    {
        return $this->hasOne(User::class,'id','id_user');
    }
}

