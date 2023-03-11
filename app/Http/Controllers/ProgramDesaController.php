<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDesa;

class ProgramDesaController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/program-desa",
     *      operationId="getProgramDesa",
     *      tags={"ProgramDesa"},
     *      summary="Get list of program desa",
     *      description="Returns list of program desa",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of program desa
     */
    public function getProgramDesa() {
        return ProgramDesa::all();
    }

    // other CRUD methods
}
