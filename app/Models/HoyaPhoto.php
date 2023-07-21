<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoyaPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "hoya_id",
        "image",
        "description",
    ];
}
