<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaProgram;
use Illuminate\Http\Request;

class PelaksanaProgramController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pelaksana-program",
     *     summary="Get all PelaksanaPrograms",
     *     tags={"Pelaksana Program"},
     *     @OA\Response(
     *         response="200",
     *         description="List of PelaksanaPrograms"
     *     )
     * )
     */
    public function index()
    {
        $pelaksanaPrograms = PelaksanaProgram::all();
        return response()->json(['data' => $pelaksanaPrograms], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/pelaksana-program",
     *     summary="Create a new PelaksanaProgram",
     *     tags={"Pelaksana Program"},
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"nama_pelaksana", "jabatan", "kontak", "program_id"},
     *                 @OA\Property(
     *                     property="nama_pelaksana",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="jabatan",
     *                     type="string",
     *                     example="Sekda"
     *                 ),
     *                 @OA\Property(
     *                     property="kontak",
     *                     type="string",
     *                     example="123456"
     *                 ),
     *                 @OA\Property(
     *                     property="program_id",
     *                     type="integer",
     *                     example="1"
     *                 ),
     *             ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="PelaksanaProgram created",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pelaksana' => 'required|string',
            'jabatan' => 'required|string',
            'kontak' => 'required|string',
            'program_id' => 'required|exists:program_desa,program_id',
        ]);

        $pelaksanaProgram = PelaksanaProgram::create($validatedData);

        return response()->json(['data' => $pelaksanaProgram], 201);
    }

    /**
     * @OA\Get(
     *   path="/api/pelaksana-program/{id}",
     *   operationId="showPelaksanaProgram",
     *   tags={"Pelaksana Program"},
     *   summary="Retrieve a single Pelaksana Program record by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Pelaksana Desa record retrieved successfully"
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Pelaksana Desa record not found"
     *   )
     * )
     */
    public function show($id)
    {
        $pelaksanaProgram = PelaksanaProgram::findOrFail($id);
        return response()->json(['data' => $pelaksanaProgram]);
    }

    /**
     * @OA\Put(
     *     path="/pelaksana-program/{id}",
     *     tags={"Pelaksana Program"},
     *     summary="Update a Pelaksana Program record",
     *     description="Update a specific Pelaksana Program record.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the Pelaksana Program to update.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"nama_pelaksana", "jabatan", "kontak", "program_id"},
     *                 @OA\Property(
     *                     property="nama_pelaksana",
     *                     type="string",
     *                     example="Bang Al"
     *                 ),
     *                 @OA\Property(
     *                     property="jabatan",
     *                     type="string",
     *                     example="Sekda"
     *                 ),
     *                 @OA\Property(
     *                     property="kontak",
     *                     type="string",
     *                     example="1234567"
     *                 ),
     *                 @OA\Property(
     *                     property="program_id",
     *                     type="integer",
     *                     example="1"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pelaksana Program not found"
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function update(Request $request, $id)
    {
        $pelaksanaProgram = PelaksanaProgram::findOrFail($id);

        $validatedData = $request->validate([
            'nama_pelaksana' => 'required|string',
            'jabatan' => 'required|string',
            'kontak' => 'required|string',
            'program_id' => 'required|exists:program_desa,program_id',
        ]);

        $pelaksanaProgram->update($validatedData);

        return response()->json(['data' => $pelaksanaProgram]);
    }

    public function destroy($id)
    {
        $pelaksanaProgram = PelaksanaProgram::findOrFail($id);
        $pelaksanaProgram->delete();

        return response()->json(null, 204);
    }
}
