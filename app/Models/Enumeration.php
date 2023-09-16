<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enumeration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "group",
        "key",
        "value",
    ];

    public static function rules()
    {
        return [
            "group"  => "required",
            "key"  => "required",
            "value"  => "required",
        ];
    }
}
