<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'region',
        'country',
        'type',
        'is_featured',
    ];


        public function packages():hasMany
{
    return $this->hasMany(TourPackage::class);



}
}
