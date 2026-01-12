<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasUuids;



protected $fillable = [
    'package_id', 
    'booking_reference',
    'first_name', 
    'last_name', 
    'email', 
    'travel_date', 
    'guest_counts', 
    'total_price',
    "status"
];


       protected function casts(): array
    {
        return [
        'guest_counts' => 'array',
        'travel_date' => 'date',
        'total_price'  => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // 1. Generate the UUID for the internal ID
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }

            // 2. Generate the Short Reference for the User
            // Results in something like: MIK-A7B2
            $model->booking_reference = 'MIK-' . strtoupper(Str::random(5));
        });
    }
   

    public function package()
    {
        return $this->belongsTo(TourPackage::class);
    }
    //
}
