<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enterprise extends Business
{
    use HasFactory;
    protected $fillable = ['enterprise_id', 'business_id'];
}
