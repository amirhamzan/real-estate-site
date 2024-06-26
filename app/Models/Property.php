<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
