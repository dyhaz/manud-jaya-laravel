<?php

namespace App\Http\Controllers;

use App\Models\JenisPerizinan;
use Illuminate\Http\Request;

class JenisPerizinanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/jenis-perizinan",
     *     operationId="getAllJenisPerizinan",
     *     summary="Get all jenis perizinan",
     *     description="Returns all jenis perizinan data",
     *     tags={"Jenis Perizinan"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse"
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        $jenisPerizinan = JenisPerizinan::all();
        return response()->json([
            'message' => 'Berhasil menampilkan semua jenis perizinan',
            'data' => $jenisPerizinan
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/jenis-perizinan",
     *     operationId="createJenisPerizinan",
     *     summary="Create new jenis perizinan",
     *     description="Create a new jenis perizinan data",
     *     tags={"Jenis Perizinan"},
     *     @OA\RequestBody(
     *         description="Jenis Perizinan data",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/JenisPerizinanInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Jenis Perizinan created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|max:255',
            'deskripsi_perizinan' => 'required'
        ]);

        $jenisPerizinan = JenisPerizinan::create([
            'nama_jenis' => $request->nama_jenis,
            'deskripsi_perizinan' => $request->deskripsi_perizinan
        ]);

        return response()->json([
            'message' => 'Berhasil menambahkan jenis perizinan',
            'data' => $jenisPerizinan
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/jenis-perizinan/{id}",
     *     operationId="getJenisPerizinan",
     *     summary="Get jenis perizinan by ID",
     *     description="Returns a single jenis perizinan data",
     *     tags={"Jenis Perizinan"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Jenis Perizinan ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis Perizinan not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show($id)
    {
        $jenisPerizinan = JenisPerizinan::find($id);

        if (!$jenisPerizinan) {
            return response()->json([
                'message' => 'Jenis perizinan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Berhasil menampilkan jenis perizinan',
            'data' => $jenisPerizinan
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/jenis-perizinan/{id}",
     *     summary="Update jenis perizinan by ID",
     *     operationId="updateJenisPerizinan",
     *     description="Update a single jenis perizinan data",
     *     tags={"Jenis Perizinan"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Jenis Perizinan ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Jenis Perizinan data",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/JenisPerizinanInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jenis Perizinan updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|max:255',
            'deskripsi_perizinan' => 'required'
        ]);

        $jenisPerizinan = JenisPerizinan::find($id);

        if (!$jenisPerizinan) {
            return response()->json([
                'message' => 'Jenis perizinan tidak ditemukan'
            ], 404);
        }

        $jenisPerizinan->nama_jenis = $request->nama_jenis;
        $jenisPerizinan->deskripsi_perizinan = $request->deskripsi_perizinan;
        $jenisPerizinan->save();

        return response()->json([
            'message' => 'Berhasil mengubah jenis perizinan',
            'data' => $jenisPerizinan
        ], 200);
    }


    /**
     * @OA\Delete(
     *   path="/api/jenis-perizinan/{id}",
     *   operationId="deleteJenisPerizinan",
     *   tags={"Jenis Perizinan"},
     *   summary="Delete by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true
     *   ),
     *   @OA\Response(
     *     response="204",
     *     description="Jenis Perizinan record deleted successfully",
     *     @OA\JsonContent()
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Jenis Perizinan record not found"
     *   )
     * )
     */
    public function destroy($id)
    {
        $jenisPerizinan = JenisPerizinan::findOrFail($id);
        $jenisPerizinan->delete();

        return response()->json(null, 204);
    }
}
