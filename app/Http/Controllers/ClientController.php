<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CLientRequest;
use App\Services\ClientService;

class ClientController extends Controller
{
    public function __construct(private readonly ClientService $service)
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * @OA\GET(
     *      path="/clients",
     *      operationId="getClients",
     *      tags={"Clients"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Get users",
     *      description="Get all clients of the auth user",
     *      @OA\Response(
     *          response=200,
     *          description="Todos los clientes",
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
     *      path="/clients",
     *      operationId="create_client",
     *      tags={"Clients"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Create client",
     *      description="Create and return one client",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "address", "logo", "phone", "dni", "enterprise_id"},
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
     *                 @OA\Property(
     *                     property="enterprise_id",
     *                     type="integer"
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "address":"Murcia 24/70 Malecon - Habana",
     *                    "logo":"base64....",
     *                    "phone":"+1522469335",
     *                    "dni":"001458796",
     *                    "coin":"USD", 
     *                    "description":"Hola esto es una descripcion",
     *                    "enterprise_id":4,                 }
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
    public function store(CLientRequest $request)
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
     *      path="/clients/{clientId}",
     *      operationId="update_client",
     *      tags={"Clients"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Update client",
     *      description="Update and return one client",
     *      @OA\Parameter(
     *      name="clientId",
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
     *                 required={"name", "address", "logo", "phone", "dni", "enterprise_id"},
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
     *                 @OA\Property(
     *                     property="enterprise_id",
     *                     type="integer"
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "address":"Murcia 24/70 Malecon - Habana",
     *                    "logo":"base64....",
     *                    "phone":"+1522469335",
     *                    "dni":"001458796",
     *                    "coin":"USD", 
     *                    "description":"Hola esto es una descripcion",
     *                    "enterprise_id":4,                 }
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
    public function update(CLientRequest $request, string $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    /**
     * @OA\DELETE(
     *      path="/clients/{clientId}",
     *      operationId="delete_client",
     *      tags={"Clients"},
     *      security={
     *      {"sanctum": {}},
     *      },
     *      summary="Delete client",
     *      description="Delete one client",
     *      @OA\Parameter(
     *      name="clientId",
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
     *                 required={"name", "address", "logo", "phone", "dni", "enterprise_id"},
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
     *                 @OA\Property(
     *                     property="enterprise_id",
     *                     type="integer"
     *                 ),
     *                 example={
     *                    "name":"Pepe",
     *                    "address":"Murcia 24/70 Malecon - Habana",
     *                    "logo":"base64....",
     *                    "phone":"+1522469335",
     *                    "dni":"001458796",
     *                    "coin":"USD", 
     *                    "description":"Hola esto es una descripcion",
     *                    "enterprise_id":4,                 }
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
