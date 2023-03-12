<?php

namespace App\Http\Controllers;

use App\Models\ProgramDesa;

class ProgramDesaController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/program",
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
    public function index() {
        $programDesa = ProgramDesa::all();
        return response()->json(['data' => $programDesa], 200);
    }

    /**
     * @OA\Delete(
     *   path="/api/program/{id}",
     *   operationId="deleteProgram",
     *   tags={"ProgramDesa"},
     *   summary="Delete by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Response(
     *     response="204",
     *     description="Program record deleted successfully"
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Program record not found"
     *   )
     * )
     */
    public function destroy($id)
    {
        $programDesa = ProgramDesa::findOrFail($id);
        $programDesa->delete();

        return response()->json(null, 204);
    }
}
