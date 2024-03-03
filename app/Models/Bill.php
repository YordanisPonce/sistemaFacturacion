<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['correlative_number', 'client_id', 'amount', 'item', 'unit_cost'];

    protected $appends = ['total_price_product', 'total_price_bill'];
    protected $with = ['taxes'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function taxes(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class, 'bill_taxes', 'bill_id', 'tax_id');
    }

    public function getTotalPriceProductAttribute(): float
    {
        return $this->unit_cost * $this->amount;
    }

    public function getTotalPriceBillAttribute(): float
    {
        $taxes = $this->taxes()->sum(DB::raw('percentage/100'));
        return $this->total_price_product + $taxes;
    }
}
