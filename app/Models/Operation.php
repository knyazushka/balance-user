<?php

namespace App\Models;

use App\Enums\OperationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    protected $table = 'operations';

    protected $guarded = ['id'];

    protected $fillable = [
        'type',
        'sum',
        'description',
        'user_id'
    ];

    protected $casts = [
        'type' => OperationType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
        );
    }
}
