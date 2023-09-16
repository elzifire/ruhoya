<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hoya extends Model
{
    use HasFactory, SoftDeletes;

    const ENUM_MORFOLOGY_KEYS = [
        "Morfologi_Batang",
        "Morfologi_Daun",
        "Morfologi_Bentuk_Bunga",
        "Morfologi_Kuncup_Bunga",
        "Morfologi_Ukuran_Bunga",
        "Morfologi_Warna_Bunga",
        "Morfologi_Akar",
        "Morfologi_Tunas",
        "Morfologi_Sistem_Reproduksi",
    ];

    protected $fillable = [
        "name",
        "local_name",
        "author",
        "origin",
        "type_information",
        "publication",
        "publication_link",
        "etymology",
        "benefit",
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

    public $with = ["hoyaImages", "hoyaSpreads"];

    public static function rules()
    {
        return [
            "name"              => "required",
            "local_name"        => "required",
            "author"            => "required",
            "origin"            => "required",
            "type_information"  => "required",
            "publication"       => "required",
            "publication_link"  => "required|url",
            "etymology"         => "required",
            "benefit"           => "required",
            "stem"              => "required",
            "leaves"            => "required",
            "flowers"           => "required",
            "flower_buds"       => "required",
            "flower_size"       => "required",
            "flower_colors"     => "required",
            "roots"             => "required",
            "shoots"            => "required",
            "reproduction_system"   => "required",
            "hoya_images"       => "array",
            "hoya_spreads"      => "array",
        ];
    }

    public function hoyaImages() {
        return $this->hasMany(HoyaImage::class);
    }
    
    public function hoyaSpreads() {
        return $this->hasMany(HoyaSpread::class);
    }
}
