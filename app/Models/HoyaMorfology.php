<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoyaMorfology extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "hoya_id",
        "morfology_id",
        "value",
    ];

    public static function rules()
    {
        return [
            "hoya_id"  => "required",
            "morfology_id"  => "required",
            "value"  => "required",
        ];
    }

    public function morfology() {
        return $this->hasOne(Morfology::class);
    }
}
