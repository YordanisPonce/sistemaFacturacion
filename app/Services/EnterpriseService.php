<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\EloquentBusinessRepositoryInterface;
use App\Interfaces\EloquentEnterpriseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class EnterpriseService
{
    public function __construct(
        private readonly EloquentEnterpriseRepositoryInterface $repository,
        private readonly EloquentBusinessRepositoryInterface $businessRepository
    ) {
    }
    public function findAll(): JsonResponse
    {
        return ResponseHelper::ok('Todas las empresas', $this->repository->findAll());

    }

    public function findById($id): JsonResponse
    {
        return ResponseHelper::ok('Empresa por id', $this->repository->findById($id));
    }

    public function save(array $attributes): JsonResponse
    {

        $business = $this->businessRepository->save($attributes);
        $enterprise = $this->repository->save($attributes + [
            'business_id' => $business->id,
            'slug' => Str::slug($business->name),
            'user_id' => auth()->id(),
        ]);
        return ResponseHelper::ok('Empresa creada satisfactoriamente', $this->repository->findById($enterprise->id));
    }

    public function update(array $attributes, $id): JsonResponse
    {

        $attributes = $attributes + ['slug' => Str::slug($attributes['name'])];

        $enterprise = $this->repository->findById($id);

        throw_if(!$enterprise, 'No se encuentra empresa con el identificador proporcionado');

        $enterprise->fill($attributes)->save();
        $enterprise->business->fill($attributes)->save();

        return ResponseHelper::ok('Empresa actualizada satisfactoriamente', $this->repository->findById($id));
    }

    public function delete($id): JsonResponse
    {
        $enterprise = $this->repository->findById($id);
        throw_if(!$enterprise, 'No se encuentra empresa con el identificador proporcionado');
        $enterprise->taxes()->delete();
        $enterprise->business->delete();
        $enterprise->delete();
        return ResponseHelper::ok('Empresa eliminada satisfactoriamente');
    }
}