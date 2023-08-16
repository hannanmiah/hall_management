<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory, Uuids;

    protected $hidden = ['id'];

    protected $appends = ['status'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class)->withDefault([
            'full_name' => 'N/A',
        ]);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function status(): Attribute
    {
        return Attribute::make(fn () => ! isset($this->student_id) || is_null($this->student_id) ? 'Unallocated' : 'Allocated');
    }
}
