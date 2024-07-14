<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()  {
        return $this->hasOne(User::class);
    }

    public function kompartement()  {
        return $this->belongsTo(kompartement::class, 'id_Kompartement');
    }
}
