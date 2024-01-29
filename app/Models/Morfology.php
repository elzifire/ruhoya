<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Morfology extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "group",
        "name",
        "slug",
        "yes_no_question",
    ];

    public static function rules()
    {
        return [
            "group"  => "required",
            "name"  => "required",
        ];
    }
}
