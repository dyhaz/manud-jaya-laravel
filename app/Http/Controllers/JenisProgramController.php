<?php

namespace App\Http\Controllers;

use App\Models\JenisProgram;
use Illuminate\Http\Request;

class JenisProgramController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/jenis-program",
     *     operationId="showJenisProgram",
     *     tags={"Jenis Program"},
     *     summary="Get all jenis program",
     *     description="Returns a list of all the jenis program.",
     *     @OA\Response(response="200", description="Successful operation")
     * )
     */
    public function index()
    {
        $programs = JenisProgram::all();

        return response()->json($programs);
    }

    /**
     * @OA\Post(
     *     path="/api/jenis-program",
     *     summary="Create a new jenis program",
     *     operationId="showJenisProgram",
     *     tags={"Jenis Program"},
     *     description="Creates a new jenis program record.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Jenis program details",
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Program A"),
     *             @OA\Property(property="deskripsi", type="string", example="Deskripsi Program A")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Jenis program created successfully"),
     *     @OA\Response(response="400", description="Bad request")
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);

        $program = JenisProgram::create([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi')
        ]);

        return response()->json(['data' => $program], 201);
    }
}
