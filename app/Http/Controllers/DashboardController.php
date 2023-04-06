<?php

namespace App\Http\Controllers;

use App\Models\JenisPerizinan;
use App\Models\ProgramDesa;
use App\Models\RequestPerizinan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        // Retrieve the number of requested perizinan
        $totalPerizinan = RequestPerizinan::all()->count();

        // Fetch all jenis perizinan records
        $jenisPerizinan = JenisPerizinan::all();

        // Prepare statistics
        $barChartData = [];

        foreach ($jenisPerizinan as $jenis) {
            // Bar chart data
            $count = RequestPerizinan::where('jenis_id', $jenis->jenis_id)->count();
            $requests = RequestPerizinan::with('warga')->where('jenis_id', $jenis->jenis_id)->get();
            $barChartData[] = [
                'jenisPerizinan' => $jenis->nama_perizinan,
                'jumlahRequest' => $count,
                'requests' => $requests
            ];
        }

        // Return the JSON response
        return response()->json(['data' => [
            'totalPrograms' => $totalPrograms,
            'totalBudget' => $totalBudget,
            'ongoingPrograms' => $ongoingPrograms,
            'completedPrograms' => $completedPrograms,
            'totalPerizinan' => $totalPerizinan,
            'perizinan' => [
                'bar' => $barChartData
            ]
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
        $startOfYear = $now->startOfYear()->toDateString();
        $endOfYear = $now->endOfYear()->toDateString();

        $monthlyAnggaran = ProgramDesa::whereBetween('tanggal_mulai', [$startOfYear, $endOfYear])
            ->selectRaw('MONTH(tanggal_mulai) as month, SUM(anggaran) as total_anggaran')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        return response()->json(['data' => $monthlyAnggaran]);
    }

    /**
     * @OA\Get(
     *   path="/api/dashboard/anggaran/{year}",
     *   operationId="anggaranByMonth",
     *   tags={"Dashboard"},
     *   summary="Show the finance report for the current year.",
     *     @OA\Parameter(
     *         name="year",
     *         in="path",
     *         description="Current year.",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *   @OA\Response(
     *     response="200",
     *     description="Dashboard record retrieved successfully"
     *   )
     * )
     */
    public function anggaranByMonth($year)
    {
        // Get the current year
        $currentYear = $year ?: date('Y');

        // Construct an array with the total anggaran for each month
        $anggaranByMonth = ProgramDesa::select(DB::raw('SUM(anggaran) as total_anggaran'), DB::raw('MONTH(tanggal_mulai) as month'))
            ->whereYear('tanggal_mulai', $currentYear)
            ->groupBy(DB::raw('MONTH(tanggal_mulai)'))
            ->pluck('total_anggaran', 'month')
            ->toArray();

        // Create an array with the total anggaran for each month, with zero as default value
        $anggaranArray = [];
        for ($i = 1; $i <= 12; $i++) {
            $anggaranArray[] = ['month' => $i,
                'total_anggaran' => $anggaranByMonth[$i] ?? 0];
        }

        return response()->json([
            'currentYear' => $currentYear,
            'data' => $anggaranArray,
        ]);
    }
}
