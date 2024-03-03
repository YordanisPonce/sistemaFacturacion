<?php

namespace App\Repositories;

use App\Interfaces\EloquentTaxRepositoryInterface;
use App\Models\Tax;

class EloquentTaxRepository implements EloquentTaxRepositoryInterface
{

  public function __construct(private readonly Tax $model)
  {
  }

  public function findAll()
  {
    return $this->model->newQuery()->get();
  }

  public function findById($id)
  {
    return $this->model->newQuery()->find($id);
  }

  public function firstOrNew($attributes)
  {
    return $this->model->newQuery()->firstOrNew($attributes);
  }

  public function save(array $attributes)
  {
    return $this->model->newQuery()->create($attributes);
  }

  public function update(array $attributes, $id)
  {
    return $this->findById($id)->update($attributes);
  }

  public function delete($id)
  {
    return $this->model->destroy($id);
  }

  public function findByEnterprise($enterpriseId)
  {
    return $this->model->newQuery()->where('enterprise_id', $enterpriseId)->get();
  }
}