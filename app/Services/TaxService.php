<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\EloquentEnterpriseRepositoryInterface;
use App\Interfaces\EloquentTaxRepositoryInterface;
use App\Interfaces\RepositoryInterface;
use Illuminate\Http\JsonResponse;

class TaxService
{
    public function __construct(
        private readonly EloquentTaxRepositoryInterface $repository,
        private readonly EloquentEnterpriseRepositoryInterface $enterpriseRepository,
    ) {
    }
    public function findAll(): JsonResponse
    {
        return ResponseHelper::ok('Todos los impuestos', $this->repository->findAll());

    }

    public function findById($id): JsonResponse
    {
        return ResponseHelper::ok('Impuestos por id', $this->repository->findById($id));
    }

    public function findByEnterprise($enterpriseId)
    {
        return ResponseHelper::ok('Impuestos por empresa', $this->repository->findByEnterprise($enterpriseId));
    }

    public function save(array $attributes): JsonResponse
    {
        $enterprise = $this->enterpriseRepository->findById($attributes['enterprise_id']);
        throw_if(!$enterprise, 'No se encuentra empresa con el identificador proporcionado');
        $tax = $this->repository->save($attributes);

        return ResponseHelper::ok('Impuesto creado satisfactoriamente', $tax);
    }

    public function update(array $attributes, $id): JsonResponse
    {
        $enterprise = $this->enterpriseRepository->findById($attributes['enterprise_id']);
        throw_if(!$enterprise, 'No se encuentra empresa con el identificador proporcionado');
        
        $tax = $this->repository->findById($id);
        throw_if(!$tax, 'No se encuentra impuesto con el identificador proporcionado');
        $tax->update($attributes);
        return ResponseHelper::ok('Impuesto actualizado satisfactoriamente', $this->repository->findById($id));
    }

    public function delete($id): JsonResponse
    {
        $tax = $this->repository->findById($id);
        throw_if(!$tax, 'No se encuentra impuesto con el identificador proporcionado');
        $tax->delete();
        return ResponseHelper::ok('Impuesto eliminado satisfactoriamente');
    }
}