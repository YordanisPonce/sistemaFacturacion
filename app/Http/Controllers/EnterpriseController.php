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
     * @OA\GET(
     *      path="/enterprises",
     *      operationId="getEnterprises",
     *      tags={"Enterprises"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Create enterprise",
     *      description="Create and return one enterprise",
     *      @OA\Response(
     *          response=200,
     *          description="Todas las empresas",
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
     *      path="/enterprises",
     *      operationId="create_enterprise",
     *      tags={"Enterprises"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Create enterprise",
     *      description="Create and return one enterprise",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "address", "logo", "phone", "dni", "coin", "description", "user_id"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="logo",
     *                    format="byte",
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="dni",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="coin",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="string"
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "address":"Murcia 24/70 Malecon - Habana",
     *                    "logo":"base64....",
     *                    "phone":"+1522469335",
     *                    "dni":"001458796",
     *                    "coin":"USD", 
     *                    "description":"Hola esto es una descripcion",
     *                    "user_id":4,                 }
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
    public function store(EnterpriseRequest $request)
    {
        try {
            return $this->service->save($request->all());
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }


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
     *      path="/enterprises/{enterpriseId}",
     *      operationId="update_enterprise",
     *      tags={"Enterprises"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Create enterprise",
     *      description="Update and return one enterprise",
     *      *      @OA\Parameter(
     *      name="enterpriseId",
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
     *                 required={"name", "address", "logo", "phone", "dni", "coin", "description", "user_id"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="logo",
     *                    format="byte",
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="dni",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="coin",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="string"
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "address":"Murcia 24/70 Malecon - Habana",
     *                    "logo":"base64....",
     *                    "phone":"+1522469335",
     *                    "dni":"001458796",
     *                    "coin":"USD", 
     *                    "description":"Hola esto es una descripcion",
     *                    "user_id":4,                 }
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
    public function update(EnterpriseRequest $request, string $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

       /**
     * @OA\DELETE(
     *      path="/enterprises/{enterpriseId}",
     *      operationId="delete_enterprise",
     *      tags={"Enterprises"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Delete enterprise",
     *      description="Delete one enterprise",
     *      *      @OA\Parameter(
     *      name="enterpriseId",
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
     *                 required={"name", "address", "logo", "phone", "dni", "coin", "description", "user_id"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="logo",
     *                    format="byte",
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="dni",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="coin",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="string"
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "address":"Murcia 24/70 Malecon - Habana",
     *                    "logo":"base64....",
     *                    "phone":"+1522469335",
     *                    "dni":"001458796",
     *                    "coin":"USD", 
     *                    "description":"Hola esto es una descripcion",
     *                    "user_id":4,                 }
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
    public function destroy(string $id)
    {
        try {
            return $this->service->delete($id);

        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }
}
