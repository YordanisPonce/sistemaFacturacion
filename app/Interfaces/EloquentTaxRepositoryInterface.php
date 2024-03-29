<?php

namespace App\Interfaces;

use App\Interfaces\RepositoryInterface;

interface EloquentTaxRepositoryInterface extends RepositoryInterface
{
    public function findByEnterprise($enterpriseId);
}