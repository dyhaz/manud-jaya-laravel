<?php

namespace App\Http\Controllers;

use App\Models\ProgramDesa;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    /**
     * @OA\Get(
     *   path="/api/dashboard/anggaran",
     *   operationId="anggaran",
     *   tags={"Dashboard"},
     *   summary="Get the total anggaran for each month in the current year.",
     *   @OA\Response(
     *     response="200",
     *     description="Dashboard record retrieved successfully"
     *   )
     * )
     */
    public function monthlyAnggaran()
    {
        $now = Carbon::now();
        $startOfYear = $now->startOfYear();
        $endOfYear = $now->endOfYear();

        $monthlyAnggaran = ProgramDesa::whereBetween('tanggal_mulai', [$startOfYear, $endOfYear])
            ->selectRaw('MONTH(tanggal_mulai) as month, SUM(anggaran) as total_anggaran')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        return response()->json(['data' => $monthlyAnggaran]);
    }
}
