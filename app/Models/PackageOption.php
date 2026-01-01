<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PackageOption extends Model
{
     use HasUuids;

     protected $table = "package_options";

     protected $fillable = [
        'options'
     ];
}
