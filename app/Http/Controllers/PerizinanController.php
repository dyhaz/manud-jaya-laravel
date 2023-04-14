<?php
namespace App\Http\Controllers;

use App\Mail\StatusPerizinan;
use App\Models\HistoriPerizinan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\RequestPerizinan;
use App\Models\Warga;

class PerizinanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/perizinan",
     *     summary="Get all perizinan requests",
     *     operationId="getPerizinan",
     *     tags={"Perizinan"},
     *     @OA\Response(
     *         response=200,
     *         description="Returns all perizinan requests",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     )
     * )
     */
    public function index()
    {
        $requests = RequestPerizinan::with('warga')->get();
        return response()->json(['data' => $requests]);
    }

    /**
     * @OA\Get(
     *      path="/api/perizinan-by-email",
     *      operationId="getPerizinanByEmail",
     *      tags={"Perizinan"},
     *      summary="Get perizinan data filtered by email and status request",
     *      description="Returns perizinan data based on email and status request",
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *       ),
     *      @OA\Response(response=400, description="Invalid input"),
     *      @OA\Response(response=404, description="Warga not found"),
     * )
     */
    public function perizinanByEmail(Request $request)
    {
        // Get request parameters
        $email = $request->input('email');
        $status = $request->input('status');

        // Validate request parameters
        if (!$email || !$status) {
            return response()->json(['message' => 'Email and status are required.'], 400);
        }

        // Find warga by email
        $warga = Warga::where('email', $email)->first();

        if (!$warga) {
            return response()->json(['message' => 'Warga not found.'], 404);
        }

        // Fetch perizinan data filtered by warga_id and status_request
        $perizinan = RequestPerizinan::where('warga_id', $warga->warga_id)
            ->where('status_request', $status)
            ->with('warga')
            ->get();

        // Return the JSON response
        return response()->json(['data' => $perizinan]);
    }

    /**
     * @OA\Post(
     *     path="/api/perizinan",
     *     summary="Create a new perizinan request",
     *     tags={"Perizinan"},
     *     operationId="createPerizinan",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body for creating a new perizinan request",
     *         @OA\JsonContent(ref="#/components/schemas/CreateRequestPerizinan")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Perizinan request created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_request' => 'required|date',
            'status_request' => 'required|string',
            'lampiran' => 'string|nullable',
            'keterangan' => 'required|string',
            'jenis_id' => 'required|exists:jenis_perizinan,jenis_id',
            'warga_id' => 'required|exists:warga,warga_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $requestPerizinan = new RequestPerizinan;
        $requestPerizinan->tanggal_request = $request->input('tanggal_request');
        $requestPerizinan->status_request = $request->input('status_request');
        $requestPerizinan->keterangan = $request->input('keterangan');
        $requestPerizinan->lampiran = $request->input('lampiran');
        $requestPerizinan->jenis_id = $request->input('jenis_id');
        $requestPerizinan->warga_id = $request->input('warga_id');
        $requestPerizinan->save();

        $warga = Warga::find($requestPerizinan->warga_id);
        if ($warga) {
            Mail::to($warga->email)->send(new StatusPerizinan($warga));

            $user = User::where('email', $warga->email)->first();
            if ($user) {
                $history = new HistoriPerizinan;
                $history->request_id = $requestPerizinan->request_id;
                $history->user_id = $user->id;
                $history->email = $user->email;
                $history->status_request = $requestPerizinan->status_request;
                $history->deskripsi = "Perizinan $history->request_id telah diajukan";
                $history->save();
            }
        }

        return response()->json(['data' => $requestPerizinan], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/perizinan/{id}",
     *     summary="Get a perizinan request by ID",
     *     operationId="getPerizinanById",
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
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan request not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFound")
     *     )
     * )
     */
    public function show($id)
    {
        $request = RequestPerizinan::with('warga')->find($id);

        if (!$request) {
            return response()->json(['error' => 'Perizinan request not found'], 404);
        }

        return response()->json(['data' => $request]);
    }

    /**
     * @OA\Put(
     *     path="/api/perizinan/{id}",
     *     summary="Update a perizinan request by ID",
     *     operationId="updatePerizinan",
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
     *         @OA\JsonContent(ref="#/components/schemas/UpdateRequestPerizinan")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Perizinan request updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/DataResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan request not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFound")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_request' => 'sometimes|date',
            'status_request' => 'sometimes|string',
            'keterangan' => 'sometimes|string',
            'jenis_id' => 'sometimes|exists:jenis_perizinan,jenis_id',
            'warga_id' => 'sometimes|exists:warga,warga_id',
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
        $requestPerizinan->save();

        $user = User::where('email', Warga::find($requestPerizinan->warga_id)->email)->first();
        if ($user) {
            $history = new HistoriPerizinan;
            $history->request_id = $requestPerizinan->request_id;
            $history->user_id = $user->id;
            $history->email = $user->email;
            $history->status_request = $requestPerizinan->status_request;
            $history->deskripsi = "Perizinan $history->request_id telah $history->status_request pada " . date('Y-m-d H:i:s');
            $history->save();
        }

        return response()->json(['data' => $requestPerizinan]);
    }

    /**
     * @OA\Delete(
     *     path="/api/perizinan/{id}",
     *     summary="Delete a perizinan request by ID",
     *     operationId="deletePerizinan",
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
     *         @OA\JsonContent(ref="#/components/schemas/NotFound")
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

    /**
     * @OA\Get(
     *     path="/api/perizinan/history/{email}",
     *     summary="Get user's last 5 perizinan history",
     *     description="Retrieve the last 5 perizinan history for a user based on email address",
     *     operationId="getHistory",
     *     tags={"Perizinan"},
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         description="Email address of the user to retrieve perizinan history for",
     *         @OA\Schema(
     *             type="string",
     *             format="email",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/DataResponse")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User not found"
     *             )
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function getUserPerizinanHistory($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $perizinanHistory = HistoriPerizinan::with('perizinan')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();

            return response()->json(['data' => $perizinanHistory]);
        } else {
            $perizinanHistory = HistoriPerizinan::where('user_id', $user->id)
                ->with('perizinan')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();

            return response()->json(['data' => $perizinanHistory]);
        }
    }
}
