<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasUuids;

public $incrementing = false;
protected $keyType = 'string';


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
