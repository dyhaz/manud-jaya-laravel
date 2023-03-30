<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RequestPerizinan;
use App\Models\JenisPerizinan;
use App\Models\Warga;

class PerizinanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/perizinan",
     *     summary="Get all perizinan requests",
     *     tags={"Perizinan"},
     *     @OA\Response(
     *         response=200,
     *         description="Returns all perizinan requests",
     *         @OA\JsonContent(ref="DataResponse")
     *     )
     * )
     */
    public function index()
    {
        $requests = RequestPerizinan::all();
        return response()->json($requests);
    }

    /**
     * @OA\Post(
     *     path="/api/perizinan",
     *     summary="Create a new perizinan request",
     *     tags={"Perizinan"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body for creating a new perizinan request",
     *         @OA\JsonContent(ref="CreateRequestPerizinan")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Perizinan request created successfully",
     *         @OA\JsonContent(ref="DataResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="ValidationError")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_request' => 'required|date',
            'status_request' => 'required|string',
            'keterangan' => 'required|string',
            'jenis_id' => 'required|exists:jenis_perizinan,id',
            'warga_id' => 'required|exists:warga,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $requestPerizinan = new RequestPerizinan;
        $requestPerizinan->tanggal_request = $request->input('tanggal_request');
        $requestPerizinan->status_request = $request->input('status_request');
        $requestPerizinan->keterangan = $request->input('keterangan');
        $requestPerizinan->jenis_id = $request->input('jenis_id');
        $requestPerizinan->warga_id = $request->input('warga_id');
        $requestPerizinan->save();

        return response()->json(['data' => $requestPerizinan], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/perizinan/{id}",
     *     summary="Get a perizinan request by ID",
     *     tags={"Perizinan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the perizinan request to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns the specified perizinan request",
     *         @OA\JsonContent(ref="DataResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan request not found",
     *         @OA\JsonContent(ref="NotFound")
     *     )
     * )
     */
    public function show($id)
    {
        $request = RequestPerizinan::find($id);

        if (!$request) {
            return response()->json(['error' => 'Perizinan request not found'], 404);
        }

        return response()->json(['data' => $request]);
    }

    /**
     * @OA\Put(
     *     path="/api/perizinan/{id}",
     *     summary="Update a perizinan request by ID",
     *     tags={"Perizinan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the perizinan request to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body for updating a perizinan request",
     *         @OA\JsonContent(ref="UpdateRequestPerizinan")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Perizinan request updated successfully",
     *         @OA\JsonContent(ref="DataResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan request not found",
     *         @OA\JsonContent(ref="NotFound")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="ValidationError")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_request' => 'sometimes|date',
            'status_request' => 'sometimes|string',
            'keterangan' => 'sometimes|string',
            'jenis_id' => 'sometimes|exists:jenis_perizinan,id',
            'warga_id' => 'sometimes|exists:warga,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $requestPerizinan = RequestPerizinan::find($id);

        if (!$requestPerizinan) {
            return response()->json(['error' => 'Perizinan request not found'], 404);
        }

        $requestPerizinan->tanggal_request = $request->input('tanggal_request', $requestPerizinan->tanggal_request);
        $requestPerizinan->status_request = $request->input('status_request', $requestPerizinan->status_request);
        $requestPerizinan->keterangan = $request->input('keterangan', $requestPerizinan->keterangan);
        $requestPerizinan->jenis_id = $request->input('jenis_id', $requestPerizinan->jenis_id);
        $requestPerizinan->warga_id = $request->input('warga_id', $requestPerizinan->warga_id);
        return response()->json(['data' => $requestPerizinan]);
    }

    /**
     * @OA\Delete(
     *     path="/api/perizinan/{id}",
     *     summary="Delete a perizinan request by ID",
     *     tags={"Perizinan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the perizinan request to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Perizinan request deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan request not found",
     *         @OA\JsonContent(ref="NotFound")
     *     )
     * )
     */
    public function destroy($id)
    {
        $request = RequestPerizinan::find($id);

        if (!$request) {
            return response()->json(['error' => 'Perizinan request not found'], 404);
        }

        $request->delete();

        return response()->noContent();
    }
}
