<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\ProgramDesa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/desa/{id}",
     *   operationId="showDesa",
     *   tags={"Desa"},
     *   summary="Retrieve a single Desa record by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="Desa record retrieved successfully"
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Desa record not found"
     *   )
     * )
     */
    public function show($id)
    {
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json(['error' => 'Desa not found'], 404);
        }

        return response()->json(['data' => $desa]);
    }

    /**
     * @OA\Get(
     *      path="/api/desa",
     *      operationId="getAllDesa",
     *      summary="Get all Desa records",
     *      description="Returns a list of all Desa records.",
     *      tags={"Desa"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function index()
    {
        $desa = Desa::all();
        return response()->json(['data' => $desa]);
    }

    /**
     * @OA\Post(
     *      path="/api/desa",
     *      operationId="createDesa",
     *      summary="Create a new Desa record",
     *      description="Creates a new Desa record with the given data.",
     *      tags={"Desa"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"nama_desa", "kecamatan", "kabupaten_kota", "provinsi", "jumlah_penduduk"},
     *                 @OA\Property(
     *                     property="nama_desa",
     *                     type="string",
     *                     example="Desa Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="kecamatan",
     *                     type="string",
     *                     example="Kecamatan Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="kabupaten_kota",
     *                     type="string",
     *                     example="Kabupaten Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="provinsi",
     *                     type="string",
     *                     example="Provinsi Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="jumlah_penduduk",
     *                     type="integer",
     *                     example="1000"
     *                 ),
     *             ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_desa' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'provinsi' => 'required|string',
            'jumlah_penduduk' => 'required|integer',
        ]);

        $desa = Desa::create($validatedData);

        return response()->json(['data' => $desa], 201);
    }

    /**
     * @OA\Put(
     *     path="/desa/{id}",
     *     tags={"Desa"},
     *     summary="Update a Desa record",
     *     description="Update a specific Desa record.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the Desa to update.",
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
     *                 required={"nama_desa", "kecamatan", "kabupaten_kota", "provinsi", "jumlah_penduduk"},
     *                 @OA\Property(
     *                     property="nama_desa",
     *                     type="string",
     *                     example="Desa Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="kecamatan",
     *                     type="string",
     *                     example="Kecamatan Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="kabupaten_kota",
     *                     type="string",
     *                     example="Kabupaten Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="provinsi",
     *                     type="string",
     *                     example="Provinsi Baru"
     *                 ),
     *                 @OA\Property(
     *                     property="jumlah_penduduk",
     *                     type="integer",
     *                     example="1000"
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
     *         description="Desa not found"
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function update(Request $request, $id)
    {
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        $this->validate($request, [
            'nama_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'jumlah_penduduk' => 'required|integer',
        ]);

        $desa->nama_desa = $request->input('nama_desa');
        $desa->kecamatan = $request->input('kecamatan');
        $desa->kabupaten_kota = $request->input('kabupaten_kota');
        $desa->provinsi = $request->input('provinsi');
        $desa->jumlah_penduduk = $request->input('jumlah_penduduk');

        $desa->save();

        return response()->json($desa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramDesa $programDesa)
    {
        //
    }
}
