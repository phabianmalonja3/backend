<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Gallery extends Model
{
 
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $table = 'galleries';
    
    protected $fillable = ['category_id', 'image_path', 'description'];

    // app/Models/Image.php


protected function imagePath(): Attribute
{
    return Attribute::make(
        get: fn ($value) => $value
            ? asset('storage/' . $value)
            : null,
    );
}



public function category()
{
    return $this->belongsTo(Category::class);

}
}