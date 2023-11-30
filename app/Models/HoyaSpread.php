<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoyaSpread extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "hoya_id",
        "latitude",
        "longitude",
        "description",
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public static function rules()
    {
        return [
            // "hoya_id"       => "requried",
            // "latitude"      => "required",
            // "longitude"     => "required",
            // "description"   => "required",
        ];
    }
}
