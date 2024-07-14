<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function arahan(){
        return $this->belongsTo(Arahan::class,'id_arahan');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
}
