<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "institute",
        "contribution",
        "image",
        "sequence",
    ];

    public static function rules()
    {
        return [
            "name"          => "required",
            "institute"     => "required",
            "contribution"  => "required",
            "sequence"      => "required",
        ];
    }
}
