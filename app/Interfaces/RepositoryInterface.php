<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function findAll();

    public function findById($id);

    public function save(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);
    public function firstOrNew($attributes);
}
