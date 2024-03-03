<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\BillRequest;
use App\Services\BillService;


class BillController extends Controller
{
    public function __construct(private readonly BillService $service)
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
    public function store(BillRequest $request)
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
