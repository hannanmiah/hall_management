<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory, Uuids;

    protected $hidden = ['id'];

    protected $appends = ['remaining'];

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function remaining(): Attribute
    {
        return Attribute::make(function () {
            return (int) $this->capacity - $this->seats->count();
        });
    }
}
