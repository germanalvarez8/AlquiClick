<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'building_id',
        'room_number',
        'bed_count',
        'price',
        'description',
        'image',
        'owner_email',
        'owner_phone',
        'owner_whatsapp',
        'amenities',
        'is_available',
    ];

    protected $casts = [
        'bed_count' => 'integer',
        'price' => 'decimal:2',
        'amenities' => 'array',
        'is_available' => 'boolean',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function getAmenitiesListAttribute()
    {
        return $this->amenities ? implode(', ', $this->amenities) : '';
    }
} 