<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\EloquentClientRepositoryInterface;
use App\Repositories\EloquentBusinessRepository;
use Illuminate\Http\JsonResponse;

class ClientService
{
    public function __construct(
        private readonly EloquentClientRepositoryInterface $repository,
        private readonly EloquentBusinessRepository $businessRepository
    ) {
    }
    public function findAll(): JsonResponse
    {
        return ResponseHelper::ok('Todos los clientes', $this->repository->findAll());

    }

    public function findById($id): JsonResponse
    {
        return ResponseHelper::ok('Clientes por id', $this->repository->findById($id));
    }

    public function save(array $attributes): JsonResponse
    {
        $business = $this->businessRepository->save($attributes);
        $client = $this->repository->save($attributes + [
            'business_id' => $business->id
        ]);

        return ResponseHelper::ok('Cliente creado satisfactoriamente', $client);
    }

    public function update(array $attributes, $id): JsonResponse
    {
        $client = $this->repository->findById($id);
        throw_if(!$client, 'No se encuentra cliente con el identificador proporcionado');
        $client->update($attributes);
        $client->business->fill($attributes)->save();
        return ResponseHelper::ok('Cliente actualizado satisfactoriamente', $this->repository->findById($id));
    }

    public function delete($id): JsonResponse
    {
        $client = $this->repository->findById($id);
        throw_if(!$client, 'No se encuentra cliente con el identificador proporcionado');
        $client->business->delete();
        $client->delete();
        return ResponseHelper::ok('Cliente eliminado satisfactoriamente');
    }
}