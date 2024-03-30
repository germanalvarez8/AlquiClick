<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerContact extends Model
{
    use HasFactory;

    protected $table = 'owners_contact';

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
