<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoyaMorphology extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "hoya_id",
        "stem",
        "leaves",
        "flowers",
        "flower_buds",
        "flower_size",
        "flower_colors",
        "roots",
        "shoots",
        "reproduction_system",
    ];
}
