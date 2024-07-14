<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kompartement() {
        return $this->belongsTo(kompartement::class, 'id_Kompartement');
    }

    public function hasil() {
        return $this->hasOne(Hasil::class,'id','id_arahan');
    }

}
