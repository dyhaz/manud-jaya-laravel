<?php

namespace App\Http\Controllers;

use App\Models\ProgramDesa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/dashboard",
     *   operationId="dashboard",
     *   tags={"Dashboard"},
     *   summary="Show the dashboard with summary data.",
     *   @OA\Response(
     *     response="200",
     *     description="Dashboard record retrieved successfully"
     *   )
     * )
     */
    public function index()
    {
        // Retrieve the total number of programs
        $totalPrograms = ProgramDesa::count();

        // Retrieve the total budget for all programs
        $totalBudget = ProgramDesa::sum('anggaran');

        // Retrieve the number of ongoing programs
        $ongoingPrograms = ProgramDesa::where('status', '1')->count();

        // Retrieve the number of completed programs
        $completedPrograms = ProgramDesa::where('status', '0')->count();

        return response()->json(['data' => [
            'totalPrograms' => $totalPrograms,
            'totalBudget' => $totalBudget,
            'ongoingPrograms' => $ongoingPrograms,
            'completedPrograms' => $completedPrograms,
        ]]);
    }
}
