<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\TaxRequest;
use App\Services\TaxService;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function __construct(private readonly TaxService $service)
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * @OA\GET(
     *      path="/taxes",
     *      operationId="getTaxes",
     *      tags={"Taxes"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Get taxes",
     *      description="Get list of taxes",
     *      @OA\Response(
     *          response=200,
     *          description="Todos los impuestos",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="not found"
     *      ),
     *      )
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
     * @OA\Post(
     *      path="/taxes",
     *      operationId="create_tax",
     *      tags={"Taxes"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Create tax",
     *      description="Create and return one tax",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "percentage", "enterprise_id"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="percentage",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="enterprise_id",
     *                    format="integer",
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "percentage": 12,
     *                    "enterprise_id" : 4  }
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Impuesto creado satisfactoriamente",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="not found"
     *      ),
     *      )
     */
    public function store(TaxRequest $request)
    {
        try {
            return $this->service->save($request->all());
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
    /**
     * @OA\GET(
     *      path="/taxes/find-by-enterprise/{enterpriseId}",
     *      operationId="getByEnterprise",
     *      tags={"Taxes"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Get taxes by enterrprise",
     *      description="Get taxes by enterprise id",
     *       @OA\Parameter(
     *         name="enterpriseId",
     *         in="path",
     *         description="Enterprise id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),  
     *      @OA\Response(
     *          response=200,
     *          description="Todos los impuestos",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="not found"
     *      ),
     *      )
     */
    public function findByEnterprise($enterpriseId)
    {
        try {
            return $this->service->findByEnterprise($enterpriseId);
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
     * @OA\PUT(
     *      path="/taxes/{taxId}",
     *      operationId="update_tax",
     *      tags={"Taxes"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Update tax",
     *      description="Update and return one tax",
     *      @OA\Parameter(
     *      name="taxId",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "percentage", "enterprise_id"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="percentage",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="enterprise_id",
     *                    format="integer",
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "percentage": 12,
     *                    "enterprise_id" : 4  }
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Impuesto creado satisfactoriamente",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="not found"
     *      ),
     *      )
     */
    public function update(TaxRequest $request, string $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    /**
     * @OA\DELETE(
     *      path="/taxes/{taxId}",
     *      operationId="delete_tax",
     *      tags={"Taxes"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Delete tax",
     *      description="Delete one tax",
     *      *      @OA\Parameter(
     *      name="taxId",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ), 
     *      @OA\Response(
     *          response=200,
     *          description="Empresa registrada satisfactoriamente",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="not found"
     *      ),
     *      )
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
