<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Hero extends Model
{

    use HasUuids;
    
    protected $fillable = [
        "title",
        "subtitle",
        "image_url"
    ];

    
    protected function imageUrl(): Attribute
{
    return Attribute::make(
        get: fn ($value) => $value
            ? asset('storage/' . $value)
            : null,
    );
}
}
