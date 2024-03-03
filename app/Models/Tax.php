<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxes';
    protected $fillable = ['name', 'percentage', 'enterprise_id'];

    public function taxes(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class, 'bill_taxes', 'tax_id', 'bill_id');
    }
}
