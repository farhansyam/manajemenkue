<?php

namespace App\Models;

use App\Models\Cookie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id_droping';
    protected $guarded = [];
    use HasFactory;


    public function cookie()
    {
        return $this->hasOne(Cookie::class,'id','id_kue');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','id_user');
    }
}

