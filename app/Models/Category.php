<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use \Illuminate\Database\Eloquent\Concerns\HasUuids;


    protected $fillable = ['name'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    
}
