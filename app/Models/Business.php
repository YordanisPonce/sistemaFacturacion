<?php

namespace App\Models;

use App\Helpers\UploadHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Business extends Model
{
    use HasFactory;
    protected $table = 'business';
    protected $fillable = ['name', 'address', 'logo', 'phone', 'dni'];

    protected $hidden = ['id'];

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Storage::disk('public')->url($value) : ""
        );
    }

    public function enterprise(): HasOne
    {
        return $this->hasOne(Enterprise::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }
}
