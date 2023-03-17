<?php

namespace App\Http\Controllers;

use App\Models\ProgramDesa;
use Illuminate\Http\Request;

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
    public function index() {
        $programDesa = ProgramDesa::all();
        return response()->json(['data' => $programDesa], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/program-desa/{id}",
     *      operationId="getProgramDesaById",
     *      tags={"ProgramDesa"},
     *      summary="Get ProgramDesa information",
     *      description="Returns ProgramDesa data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ProgramDesa ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="ProgramDesa not found"
     *      )
     * )
     */
    public function show($id)
    {
        $program_desa = ProgramDesa::findOrFail($id);
        return response()->json(['data' => $program_desa]);
    }

    /**
     * @OA\Post(
     *      path="/api/program-desa",
     *      operationId="storeProgramDesa",
     *      tags={"ProgramDesa"},
     *      summary="Store new ProgramDesa",
     *      description="Returns ProgramDesa data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"nama_program", "deskripsi_program", "tanggal_mulai", "tanggal_selesai"},
     *                 @OA\Property(
     *                     property="nama_program",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="deskripsi_program",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="tanggal_mulai",
     *                     type="string",
     *                     example="2022-03-03"
     *                 ),
     *                 @OA\Property(
     *                     property="tanggal_selesai",
     *                     type="string",
     *                     example="2022-03-03"
     *                 ),
     *                 @OA\Property(
     *                     property="anggaran",
     *                     type="string",
     *                     example="100000000"
     *                 ),
     *                 @OA\Property(
     *                     property="foto",
     *                     type="string",
     *                     example=""
     *                 ),
     *             ),
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Header to indicate the requested content type",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              default="application/json"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string',
            'tanggal_mulai' => 'required|string',
            'tanggal_selesai' => 'required|string',
            'foto' => 'string|nullable',
            'anggaran' => 'string|nullable'
        ]);

        if (empty($validatedData['desa_id'])) {
            $validatedData['desa_id'] = '1';
        }

        $program_desa = ProgramDesa::create($validatedData);

        return response()->json(['data' => $program_desa], 201);
    }

    /**
     * @OA\Put(
     *      path="/api/program-desa/{id}",
     *      operationId="updateProgramDesa",
     *      tags={"ProgramDesa"},
     *      summary="Update existing ProgramDesa",
     *      description="Returns updated ProgramDesa data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ProgramDesa ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"nama_program", "deskripsi_program", "tanggal_mulai", "tanggal_selesai"},
     *                 @OA\Property(
     *                     property="nama_program",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="deskripsi_program",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="tanggal_mulai",
     *                     type="string",
     *                     example="2022-03-03"
     *                 ),
     *                 @OA\Property(
     *                     property="tanggal_selesai",
     *                     type="string",
     *                     example="2022-03-03"
     *                 ),
     *                 @OA\Property(
     *                     property="anggaran",
     *                     type="string",
     *                     example="100000000"
     *                 ),
     *                 @OA\Property(
     *                     property="foto",
     *                     type="string",
     *                     example=""
     *                 ),
     *             ),
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="Header to indicate the requested content type",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              default="application/json"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="ProgramDesa not found"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $program_desa = ProgramDesa::findOrFail($id);
        $program_desa->nama_program = $request->input('nama_program');
        $program_desa->deskripsi_program = $request->input('deskripsi_program');
        $program_desa->tanggal_mulai = $request->input('tanggal_mulai');
        $program_desa->tanggal_selesai = $request->input('tanggal_selesai');
        $program_desa->foto = $request->input('foto');
        $program_desa->anggaran = $request->input('anggaran');

        if (!empty($request->input('desa_id'))) {
            $program_desa->desa_id = $request->input('desa_id');
        } else {
            $program_desa->desa_id = '1';
        }
        $program_desa->save();
        return response()->json(['data' => $program_desa]);
    }

    /**
     * @OA\Delete(
     *   path="/api/program-desa/{id}",
     *   operationId="deleteProgram",
     *   tags={"ProgramDesa"},
     *   summary="Delete by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Parameter(
     *      name="Accept",
     *      in="header",
     *      description="Header to indicate the requested content type",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          default="application/json"
     *      )
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
