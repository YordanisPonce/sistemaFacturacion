<?php

namespace App\Interfaces;
use App\Interfaces\RepositoryInterface;

interface EloquentUserRepositoryInterface extends RepositoryInterface
{
   public function findByEmail($email);
}