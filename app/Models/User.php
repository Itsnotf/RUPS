<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Kompartement()  {
        return $this->belongsTo(kompartement::class, 'id_Kompartement');
    }

    public function Department()  {
        return $this->belongsTo(departement::class, 'id_Department');
    }

    public function Jabatan()  {
        return $this->belongsTo(Jabatan::class,'id_Jabatan');
    }

    public function arahan(){
        return $this->hasOne(Arahan::class,'id','id_user');
    }

    public function hasil(){
        return $this->hasOne(Arahan::class,'id','id_user');
    }
}
