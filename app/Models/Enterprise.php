<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Enterprise extends Model
{
    use HasFactory;
    protected $fillable = ['business_id', 'slug', 'coin', 'description', 'user_id'];

    protected $with = ['business'];
    protected $hidden = ['business_id'];
    public function taxes(): HasMany
    {
        return $this->hasMany(Tax::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
