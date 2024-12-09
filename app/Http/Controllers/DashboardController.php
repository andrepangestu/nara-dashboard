<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Get anorganic data filtered by date range.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getDataAnorganic(Request $request)
    {
        $user = Session::get('user');

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        
        $data = DB::table('tbl_anorganic_recap')
        ->whereBetween('date', [$startDate, $endDate])
        ->where('company_id', $user->role)
        ->get();
            
        $newObject = new \stdClass();
        $newObject->date = $data->first()->date ?? null;
        $newObject->company_id = $data->first()->company_id ?? null;
        $newObject->plastic_ldpe = $data->sum('plastic_ldpe') ?? 0;
        $newObject->plastic_hdpe = $data->sum('plastic_hdpe') ?? 0;
        $newObject->plastic_pet = $data->sum('plastic_pet') ?? 0;
        $newObject->plastic_pp = $data->sum('plastic_pp') ?? 0;
        $newObject->beling = $data->sum('beling') ?? 0;
        $newObject->aluminium = $data->sum('aluminium') ?? 0;
        $newObject->besi = $data->sum('besi') ?? 0;
        $newObject->kaleng = $data->sum('kaleng') ?? 0;
        $newObject->kertas = $data->sum('kertas') ?? 0;
        $newObject->kardus = $data->sum('kardus') ?? 0;
        $newObject->gabruk = $data->sum('gabruk') ?? 0;
        $newObject->total_data_daily = $data->sum('total_data_daily') ?? 0;

        return response()->json($newObject);
    }

    public function getDataOrganic(Request $request)
    {
        $user = Session::get('user');

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = \DB::table('tbl_organic_recap')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('company_id', $user->role)
            ->get();
            
        $newObject = new \stdClass();
        $newObject->date = $data->first()->date ?? null;
        $newObject->company_id = $data->first()->company_id ?? null;
        $newObject->sampah_organik = $data->sum('sampah_organik') ?? 0;
        $newObject->minyak_jelantah = $data->sum('minyak_jelantah') ?? 0;
        $newObject->total_data_daily = $data->sum('total_data_daily') ?? 0;

        return response()->json($newObject);
    }

    public function getDataSummary(Request $request)
    {
        $user = Session::get('user');

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = \DB::table('tbl_summary_recap')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('company_id', $user->role)
            ->get();
            
        $newObject = new \stdClass();
        $newObject->date = $data->first()->date ?? null;
        $newObject->company_id = $data->first()->company_id ?? null;
        $newObject->total_all_waste = $data->sum('total_all_waste') ?? 0;
        $newObject->residu = $data->sum('residu') ?? 0;
        $newObject->economic_value = $data->sum('economic_value') ?? 0;
        $newObject->manage_by_tpst = $data->sum('manage_by_tpst') ?? 0;
        $newObject->manage_by_wastebank = $data->sum('manage_by_wastebank') ?? 0;

        return response()->json($newObject);
    }

    public function getDataTypeWaste(Request $request)
    {
        $user = Session::get('user');
        
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $data = \DB::table('tbl_summary_recap')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('company_id', $user->role)
            ->get();
            
        $newObject = new \stdClass();
        $newObject->date = $data->first()->date ?? null;
        $newObject->company_id = $data->first()->company_id ?? null;
        $newObject->total_organic = $data->sum('total_all_data_organic') ?? 0;
        $newObject->total_anorganic = $data->sum('total_all_data_anorganic') ?? 0;
        $newObject->residu = $data->sum('residu') ?? 0;
        $newObject->total_all_waste = $data->sum('total_all_waste') ?? 0;

        return response()->json($newObject);
    }

    public function getDataAmountsWasteByDay(Request $request)
    {
        $user = Session::get('user');

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = \DB::table('tbl_summary_recap')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('company_id', $user->role)
            ->get();

        $mappedData = $data->map(function ($item) {
            return [
                'date' => $item->date,
                'total_data_anorganic' => $item->total_all_data_anorganic,
                'total_data_organic' => $item->total_all_data_organic,
                'total_data_residu' => $item->residu,
                'total_all_waste' => $item->total_all_waste,
            ];
        });

        return response()->json($mappedData);
    }

    public function getDataAmountsWasteByMonth(Request $request)
    {
        $user = Session::get('user');

        $request->validate([
            'selected_date' => 'required|date',
        ]);

        $selected_date = $request->input('selected_date');

        $data = \DB::table('tbl_summary_recap')
            ->where('company_id', $user->role)
            ->whereBetween('date', [
                \Carbon\Carbon::parse($selected_date)->startOfMonth()->subMonths(10),
                \Carbon\Carbon::parse($selected_date)->endOfMonth()
            ])
            ->groupBy(\DB::raw('YEAR(date)'), \DB::raw('MONTH(date)'))
            ->select(
                \DB::raw('YEAR(date) as year'),
                \DB::raw('MONTH(date) as month'),
                \DB::raw('SUM(total_all_data_anorganic) as total_all_data_anorganic'),
                \DB::raw('SUM(total_all_data_organic) as total_all_data_organic'),
                \DB::raw('SUM(residu) as residu'),
                \DB::raw('SUM(total_all_waste) as total_all_waste')
            )
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $mappedData = $data->map(function ($item) {
            return [
                'year' => $item->year,
                'month' => $item->month,
                'total_data_anorganic' => $item->total_all_data_anorganic,
                'total_data_organic' => $item->total_all_data_organic,
                'total_data_residu' => $item->residu,
                'total_all_waste' => $item->total_all_waste,
            ];
        });

        return response()->json($mappedData);
    }
}