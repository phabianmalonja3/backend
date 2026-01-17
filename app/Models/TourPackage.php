<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TourPackage extends Model
{
    use HasUuids;
    protected $table="packages";
 protected $fillable = [
    'name', 
    'price', 
    'days',     // Add this
    'nights',   // Add this
    'image_url', 
    'options', 
    'location_id', 
    'active'
];
    
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
           'options' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
        ];
    }

    public function location()
{
    return $this->belongsTo(Location::class);

}
    
}
