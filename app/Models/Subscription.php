<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'plan', 'status', 'payment_ref', 'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if subscription is active
    public function isActive(): bool
    {
        return $this->status === 'active' &&
               $this->expires_at->isFuture();
    }
}
