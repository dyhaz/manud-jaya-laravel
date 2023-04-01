<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Warga;

class WargaController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/warga",
     *      operationId="getAllWarga",
     *      tags={"Warga"},
     *      summary="Get all warga data",
     *      description="Returns all warga data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="an 'unexpected error' occurred",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
     */
    public function index()
    {
        $warga = Warga::all();
        return response()->json([
            'success' => true,
            'data' => $warga
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/warga/{id}",
     *      operationId="getWargaById",
     *      tags={"Warga"},
     *      summary="Get warga data by id",
     *      description="Returns warga data based on given id",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the warga to get",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Warga not found",
     *          @OA\JsonContent(ref="#/components/schemas/NotFound")
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="an 'unexpected error' occurred",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
     */
    public function show($id)
    {
        $warga = Warga::find($id);

        if (!$warga) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $warga
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/warga",
     *      operationId="storeWarga",
     *      tags={"Warga"},
     *      summary="Store new warga",
     *      description="Stores new warga data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Warga")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Warga data stored successfully",
     *          @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Data validation error",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      ),
     *      @OA\Response(
     *          response="default",
     *          description="an 'unexpected error' occurred",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_warga' => 'required|string',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
            'email' => 'required|string|email|unique:warga',
            'nik' => 'required|string|unique:warga',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $warga = new Warga;
        $warga->nama_warga = $request->nama_warga;
        $warga->alamat = $request->alamat;
        $warga->nomor_telepon = $request->nomor_telepon;
        $warga->email = $request->email;
        $warga->nik = $request->nik;
        $warga->save();

        return response()->json([
            'success' => true,
            'data' => $warga
        ], 201);
    }

    /**
     * @OA\Put(
     *      path="/api/warga/{id}",
     *      operationId="updateWarga",
     *      tags={"Warga"},
     *      summary="Update existing warga data",
     *      description="Updates existing warga data based on given id",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the warga to update",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Warga")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Warga data updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_warga' => 'required|string',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
            'email' => 'required|string|email|unique:warga,email,' . $id . ',warga_id',
            'nik' => 'required|string|unique:warga,nik,' . $id . ',warga_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $warga = Warga::find($id);

        if (!$warga) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }

        $warga->nama_warga = $request->nama_warga;
        $warga->alamat = $request->alamat;
        $warga->nomor_telepon = $request->nomor_telepon;
        $warga->email = $request->email;
        $warga->nik = $request->nik;
        $warga->save();

        return response()->json([
            'success' => true,
            'data' => $warga
        ], 200);
    }
}