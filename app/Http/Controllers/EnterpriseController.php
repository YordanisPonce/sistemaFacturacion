<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\EnterpriseRequest;
use App\Services\EnterpriseService;
use Illuminate\Http\Request;

;
use Illuminate\Support\Facades\Log;

class EnterpriseController extends Controller
{

    public function __construct(private readonly EnterpriseService $service)
    {
         $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return $this->service->findAll();
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(EnterpriseRequest $request)
    {
        try {
            return $this->service->save($request->all());
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return $this->service->findById($id);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EnterpriseRequest $request, string $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return $this->service->delete($id);

        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
}
