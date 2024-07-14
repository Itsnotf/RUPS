<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kompartement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()  {
        return $this->hasOne(User::class, 'id', 'id_Kompartement');
    }

    public function department() {
        return $this->hasOne(departement::class);
    }

    public function arahan(){
        return $this->hasOne(Arahan::class, 'id', 'id_Kompartement');
    }
}
