<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasUuids;

    protected $fillable = [

        "category_id",
        "images",
        "title",
        "descriptions",

    ];

 
   protected function casts(): array
    {
        return [
            "images"=>"array"
        ];
    }
}
