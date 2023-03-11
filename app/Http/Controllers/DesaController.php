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

        return response()->json($desa);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramDesa $programDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramDesa $programDesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramDesa $programDesa)
    {
        //
    }
}
