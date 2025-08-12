<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'address',
        'preview_image_src',
        'price_in_euros',
        'parking_spaces',
        'bathrooms',
        'living_rooms',
        'available_from',
        'available_to',
        'available',
    ];
}
