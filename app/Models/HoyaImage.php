<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

use App\Models\Hoya;

class HoyaImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "hoya_id",
        "image",
        "description",
        "photographer",
    ];

    public static function rules($isUpdate = false)
    {
        return [
            // "hoya_id"       => "requried",
            // "file"          => [Rule::requiredIf($isUpdate === false), "file"],
            // "description"   => "required",
            // "photographer"  => "required",
        ];
    }

    public function hoya()
    {
        return $this->hasOne(Hoya::class, "id", "hoya_id");
    }
}
