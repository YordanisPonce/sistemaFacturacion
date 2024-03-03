<?php

namespace App\Traits;

use App\Models\Client;
use App\Models\Enterprise;
use App\Models\Business as BusinesModel;
use Illuminate\Support\Facades\Log;

trait Business
{
    public function getFreeBusiness(): ?BusinesModel
    {

        $business = BusinesModel::whereDoesntHave('client')->whereDoesntHave('enterprise')->first();
        return $business;
    }
}