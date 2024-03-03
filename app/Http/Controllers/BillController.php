<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\BillRequest;
use App\Services\BillService;

/**
 * @group Bill Management
 *
 * APIs for managing bills
 */
class BillController extends Controller
{
    public function __construct(private readonly BillService $service)
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @OA\GET(
     *      path="/bills?enterpriseId={enterpriseId}&days={days}&clientId={clientId}",
     *      operationId="getBills",
     *      tags={"Bills"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Get all bills",
     *             @OA\Parameter(
     *         name="clientId",
     *         in="query",
     *         description="First query parameter",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="enterpriseId",
     *         in="query",
     *         description="Second query parameter",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),    
     *     @OA\Parameter(
     *         name="days",
     *         in="query",
     *         description="Second query parameter",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ), 
     *      @OA\Response(
     *          response=200,
     *          description="Todas las facturas",
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
     *      path="/bills",
     *      operationId="create_bill",
     *      tags={"Bills"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Create bill",
     *      description="Create and return one bill",   
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"client_id", "amount", "item", "unit_cost"},
     *                 @OA\Property(
     *                     property="client_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="amount",
     *                     type="double"
     *                 ),
     *                 @OA\Property(
     *                     property="item",
     *                    format="string",
     *                 ),
     *                 @OA\Property(
     *                     property="unit_cost",
     *                     type="double"
     *                 ),
     *                 example={
     *                  "client_id":4, 
     *                  "amount":124, 
     *                  "item":"Product descripton",
     *                  "unit_cost":25.54    
     *           }
     *             )
     *         )
     *     ),
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
