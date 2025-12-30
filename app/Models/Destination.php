<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Destination extends Model
{
    use HasUuids;
    
    protected $fillable = ['name',"location","status","image_url",'features'];

    protected function casts(): array
    {
        return [
            'features' => 'array',
        ];
    }


    protected function imageUrl(): Attribute
{
    return Attribute::make(
        get: fn ($value) => $value
            ? asset('storage/' . $value)
            : null,
    );
}
}
