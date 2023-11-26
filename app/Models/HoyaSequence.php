<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class HoyaSequence extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        "hoya_id",
        "dna_type",
        "dna_sequence",
        "link",
    ];

    public static function rules($isUpdate = false)
    {
        return [
            // "hoya_id"       => "requried",
            // "dna_sequence"  => "required",
        ];
    }
}
