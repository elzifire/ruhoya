<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hoya extends Model
{
    use HasFactory, SoftDeletes;

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
    ];
}
