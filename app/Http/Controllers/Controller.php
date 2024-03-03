<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title=L5_SWAGGER_CONST_NAME, version="1.0")
 *
 * @OA\Server(url=L5_SWAGGER_CONST_HOST)
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
