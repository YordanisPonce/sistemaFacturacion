<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\EloquentBillRepositoryInterface;
use App\Interfaces\EloquentClientRepositoryInterface;
use App\Interfaces\EloquentEnterpriseRepositoryInterface;
use App\Interfaces\EloquentTaxRepositoryInterface;
use App\Models\Enterprise;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BillService
{
    public function __construct(
        private readonly EloquentBillRepositoryInterface $repository,
        private readonly EloquentClientRepositoryInterface $clientRepository,
        private readonly EloquentTaxRepositoryInterface $taxRepository,
    ) {
    }
    public function findAll(): JsonResponse
    {
        return ResponseHelper::ok('Todas las facturas', $this->repository->findAll());
    }

    public function findById($id): JsonResponse
    {
        return ResponseHelper::ok('Factura por id', $this->repository->findById($id));
    }

    public function save(array $attributes): JsonResponse
    {

        $client = $this->clientRepository->findById($attributes['client_id']);
        throw_if(!$client, 'No se encuentra cliente para realizar la factura');

        $bill = $client->bills()->create($attributes + ['correlative_number' => $this->getCorrelativeNumber($client->enterprise)]);
        $bill->taxes()->attach($attributes['taxes']);

        return ResponseHelper::ok('Factura creada satisfactoriamente', $bill);
    }

    public function delete($id): JsonResponse
    {
        $bill = $this->repository->findById($id);
        throw_if(!$bill, 'No se encuentra factura con el identificador proporcionado');
        $bill->delete();
        return ResponseHelper::ok('Factura eliminado satisfactoriamente');
    }

    private function getCorrelativeNumber(Enterprise $enterprise): string
    {
        $code = ($enterprise->slug ? $enterprise->slug . '-' : '') . strval($enterprise->id) . '-' . strval(Carbon::now()->year);
        return $code;
    }
}