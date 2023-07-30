<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "image",
    ];

    public static function rules()
    {
        return [
            "title"  => "required",
            "description"  => "required",
            "image"  => "required"
        ];
    }
}
