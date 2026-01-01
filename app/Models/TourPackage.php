<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TourPackage extends Model
{
    use HasUuids;
    protected $fillable = ["name","price",'options','image_url','active','location'];
  protected function imageUrl(): Attribute
{
    return Attribute::make(
        get: fn ($value) => $value
            ? asset('storage/' . $value)
            : null,
    );
}

   protected function casts(): array
    {
        return [
            "options"=>"array"
        ];
    }
    
}
