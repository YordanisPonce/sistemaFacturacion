<?php

namespace App\Repositories;

use App\Interfaces\EloquentEnterpriseRepositoryInterface;
use App\Models\Enterprise;

class EloquentEnterpriseRepository implements EloquentEnterpriseRepositoryInterface
{

  public function __construct(private readonly Enterprise $model)
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
    return $this->model->newQuery()->create(collect($attributes)->only(($this->model->getFillable()))->toArray());
  }

  public function update(array $attributes, $id)
  {
    $model = $this->findById($id);
    $model->update($attributes);
    return $model->refresh();
  }

  public function delete($id)
  {
    return $this->model->destroy($id);
  }
}