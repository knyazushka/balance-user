<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $balance
 * @property CarbonImmutable|string $created_at
 * @property CarbonImmutable|string $updated_at
 * @property User $user
 */
class Balance extends Model
{
    protected $table = 'balances';

    protected $guarded = ['id'];

    protected $fillable = [
        'balance',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
        );
    }
}
