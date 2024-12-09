<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SummaryCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = Session::get('user');
        $currentDate = Carbon::now()->toDateString();
        
        $data = \DB::table('tbl_summary_recap')
            ->whereBetween('date', ['2024-11-20', $currentDate])
            ->where('company_id', $user->role)
            ->get();
            
        $newObject = new \stdClass();
        $firstData = $data->first();
        if ($firstData) {
            $newObject->date = $firstData->date;
            $newObject->company_id = $firstData->company_id;
        } else {
            $newObject->date = null;
            $newObject->company_id = null;
        }

        $newObject->total_all_waste = $data->sum('total_all_waste');
        $newObject->residu = $data->sum('residu');
        $newObject->economic_value = $data->sum('economic_value');
        $newObject->manage_by_tpst = $data->sum('manage_by_tpst');
        $newObject->manage_by_wastebank = $data->sum('manage_by_wastebank');

        // dd($newObject);
        return view('components.summary-card', [
            'total_all_waste' => $newObject->total_all_waste,
            'residu' => $newObject->residu,
            'economic_value' => $newObject->economic_value,
            'manage_by_tpst' => $newObject->manage_by_tpst,
            'manage_by_wastebank' => $newObject->manage_by_wastebank,
        ]);
        
        // return view('components.summary-card');
    }
}