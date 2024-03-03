<?php

namespace App\Repositories;

use App\Interfaces\EloquentBillRepositoryInterface;
use App\Models\Bill;
use Carbon\Carbon;

class EloquentBillRepository implements EloquentBillRepositoryInterface
{

  public function __construct(private readonly Bill $model)
  {
  }

  public function findAll()
  {
    $filter = function ($query) {
      $clientId = request()->get("clientId");
      $enterpriseId = request()->get("enterpriseId");
      $days = request()->get("days");

      if ($clientId) {
        $query->where("client_id", $clientId);
      }

      if ($enterpriseId) {
        $query->whereHas("client", function ($subquery) use ($enterpriseId) {
          $subquery->where("enterprise_id", $enterpriseId);
        });
      }

      if (isset ($days)) {
        $startDate = Carbon::today()->subDays($days);
        $query->whereDate('created_at', '>=', $startDate);
      }
    };

    return $this->model->newQuery()
      ->whereHas('client', function ($query) {
        $query->whereHas('enterprise', function ($subquery) {
          $subquery->where('user_id', auth()->id());
        });
      })
      ->where($filter)
      ->get();
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
}