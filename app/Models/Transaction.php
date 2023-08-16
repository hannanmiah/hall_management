<?php

namespace App\Models;

use App\Enums\Casts\TransactionName;
use App\Enums\Casts\TransactionStatus;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory, Uuids;

    protected $hidden = ['id'];

    protected $casts = [
        'name' => TransactionName::class,
        'amount' => 'float',
        'status' => TransactionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
