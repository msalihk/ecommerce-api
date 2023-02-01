<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function city()
    {
        $this->belongsTo(City::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
