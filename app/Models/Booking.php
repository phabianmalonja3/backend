<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasUuids;



protected $fillable = [
    'package_id', 
    'first_name', 
    'last_name', 
    'email', 
    'travel_date', 
    'guest_counts', 
    'total_price'
];


       protected function casts(): array
    {
        return [
            'guest_counts' => 'array',
        'travel_date' => 'date',
        ];
    }

   

    public function package()
    {
        return $this->belongsTo(TourPackage::class);
    }
    //
}
