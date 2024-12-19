<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;
use Illuminate\Support\Facades\Session;
use DateTime;
use DatePeriod;
use DateInterval;

class SheetDbController extends Controller
{
    // SAVE DATA ANORGANIC
    public function saveDataAnorganic($data, $companyId) {
        $existingRecordAnorganic = \DB::table('tbl_anorganic_recap')
        ->where('date', $data['Date'])
        ->where('company_id', $companyId)
        ->first();

        
        if ($existingRecordAnorganic) {
            \DB::table('tbl_anorganic_recap')
            ->where('date', $data['Date'])
            ->where('company_id', $companyId)
            ->update([
                'plastic_ldpe' => !empty($data['Plastic LDPE']) ? $data['Plastic LDPE'] : 0,
                'plastic_hdpe' => !empty($data['Plastic HDPE']) ? $data['Plastic HDPE'] : 0,
                'plastic_pet' => !empty($data['Plastic PET']) ? $data['Plastic PET'] : 0,
                'plastic_pp' => !empty($data['Plastic PP']) ? $data['Plastic PP'] : 0,
                'beling' => !empty($data['Beling']) ? $data['Beling'] : 0,
                'aluminium' => !empty($data['Aluminium']) ? $data['Aluminium'] : 0,
                'besi' => !empty($data['Besi']) ? $data['Besi'] : 0,
                'kaleng' => !empty($data['Kaleng']) ? $data['Kaleng'] : 0,
                'kertas' => !empty($data['Kertas']) ? $data['Kertas'] : 0,
                'kardus' => !empty($data['Kardus']) ? $data['Kardus'] : 0,
                'gabruk' => !empty($data['Gabruk']) ? $data['Gabruk'] : 0,
                'total_data_daily' => !empty($data['Total Data Anorganik Harian']) ? $data['Total Data Anorganik Harian'] : 0,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['message' => 'Data updated successfully']);
        } else {
            \DB::table('tbl_anorganic_recap')->insert([
                'date' => $data['Date'],
                'company_id' => $companyId,
                'plastic_ldpe' => isset($data['Plastic LDPE']) ? $data['Plastic LDPE'] : null,
                'plastic_hdpe' => isset($data['Plastic HDPE']) ? $data['Plastic HDPE'] : null,
                'plastic_pet' => isset($data['Plastic PET']) ? $data['Plastic PET'] : null,
                'plastic_pp' => isset($data['Plastic PP']) ? $data['Plastic PP'] : null,
                'beling' => isset($data['Beling']) ? $data['Beling'] : null,
                'aluminium' => isset($data['Aluminium']) ? $data['Aluminium'] : null,
                'besi' => isset($data['Besi']) ? $data['Besi'] : null,
                'kaleng' => isset($data['Kaleng']) ? $data['Kaleng'] : null,
                'kertas' => isset($data['Kertas']) ? $data['Kertas'] : null,
                'kardus' => isset($data['Kardus']) ? $data['Kardus'] : null,
                'gabruk' => isset($data['Gabruk']) ? $data['Gabruk'] : null,
                'total_data_daily' => isset($data['Total Data Anorganik Harian']) ? $data['Total Data Anorganik Harian'] : null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['message' => 'Data saved successfully']);
        }
    }

    // SAVE DATA ORGANIC
    public function saveDataOrganic($data, $companyId) {
        $existingRecordOrganic = \DB::table('tbl_organic_recap')
            ->where('date', $data['Date'])
            ->where('company_id', $companyId)
            ->first();
        
        
        if ($existingRecordOrganic) {
            \DB::table('tbl_organic_recap')
            ->where('date', $data['Date'])
            ->where('company_id', $companyId)
            ->update([
                'sampah_organik' => isset($data['Sampah Organik']) ? $data['Sampah Organik'] : null,
                'minyak_jelantah' => isset($data['Minyak Jelantah']) ? $data['Minyak Jelantah'] : null,
                'total_data_daily' => isset($data['Total Data Organik Harian']) ? $data['Total Data Organik Harian'] : null,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['message' => 'Data updated successfully']);
        } else {
            \DB::table('tbl_organic_recap')->insert([
                'date' => $data['Date'],
                'company_id' => $companyId,
                'sampah_organik' => isset($data['Sampah Organik']) ? $data['Sampah Organik'] : null,
                'minyak_jelantah' => isset($data['Minyak Jelantah']) ? $data['Minyak Jelantah'] : null,
                'total_data_daily' => isset($data['Total Data Organik Harian']) ? $data['Total Data Organik Harian'] : null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['message' => 'Data saved successfully']);
        }
    }

    // SAVE DATA SUMMARY
    public function saveDataSummary($data, $companyId) {
        $existingRecordSummary = \DB::table('tbl_summary_recap')
            ->where('date', $data['Date'])
            ->where('company_id', $companyId)
            ->first();

        if ($existingRecordSummary) {
            \DB::table('tbl_summary_recap')
            ->where('date', $data['Date'])
            ->where('company_id', $companyId)
            ->update([
                'residu' => isset($data['Residu']) ? $data['Residu'] : null,
                'economic_value' => isset($data['Economic Value']) ? $data['Economic Value'] : null,
                'manage_by_tpst' => isset($data['Manage by TPST']) ? $data['Manage by TPST'] : null,
                'manage_by_wastebank' => isset($data['Manage by Wastebank']) ? $data['Manage by Wastebank'] : null,
                'total_all_data_anorganic' => isset($data['Total Seluruh Data Anorganik']) ? $data['Total Seluruh Data Anorganik'] : null,
                'total_all_data_organic' => isset($data['Total Seluruh Data Organik']) ? $data['Total Seluruh Data Organik'] : null,
                'total_all_waste' => isset($data['Total Seluruh Sampah']) ? $data['Total Seluruh Sampah'] : null,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['message' => 'Data updated successfully']);
        } else {
            \DB::table('tbl_summary_recap')->insert([
                'date' => $data['Date'],
                'company_id' => $companyId,
                'residu' => isset($data['Residu']) ? $data['Residu'] : null,
                'economic_value' => isset($data['Economic Value']) ? $data['Economic Value'] : null,
                'manage_by_tpst' => isset($data['Manage by TPST']) ? $data['Manage by TPST'] : null,
                'manage_by_wastebank' => isset($data['Manage by Wastebank']) ? $data['Manage by Wastebank'] : null,
                'total_all_data_anorganic' => isset($data['Total Seluruh Data Anorganik']) ? $data['Total Seluruh Data Anorganik'] : null,
                'total_all_data_organic' => isset($data['Total Seluruh Data Organik']) ? $data['Total Seluruh Data Organik'] : null,
                'total_all_waste' => isset($data['Total Seluruh Sampah']) ? $data['Total Seluruh Sampah'] : null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['message' => 'Data saved successfully']);
        }
    }

    public function saveData($companyId, $responseData) {
        if (!empty($responseData)) {
            foreach ($responseData as $data) {
                $this->saveDataAnorganic($data, $companyId);
                $this->saveDataOrganic($data, $companyId);
                $this->saveDataSummary($data, $companyId);
            }
        } else {
            return response()->json(['message' => 'No data found']);
        }
    }

    public function saveDataAllCompany() {
        date_default_timezone_set('Asia/Jakarta');
        $sheetDbApiKey = env('SHEETDB_API_KEY');
        $date = date('Y-m-d');
        $companies = \DB::table('company')->get();
        
        foreach ($companies as $company) {
            $sheetDb = new SheetDB($sheetDbApiKey, $company->name);
            
            $response = $sheetDb->search(['Date' => $date]);
            $responseData = json_decode(json_encode($response), true);

            if (!empty($responseData)) {
                $this->saveData($company->id, $responseData);
            }
        }
    }

    public function saveDataManualRangeDate($companyName, $startDate, $endDate) {
        set_time_limit(1800); // 30 Minutes
        
        $sheetDbApiKey = env('SHEETDB_API_KEY');
        $company = \DB::table('company')->where('name', $companyName)->first();
        $sheetDb = new SheetDB($sheetDbApiKey, $company->name);

        $dateRange = [];
        try {
            $start = DateTime::createFromFormat('Y-m-d', $startDate);
            $end = DateTime::createFromFormat('Y-m-d', $endDate);

            if (!$start || !$end) {
                return response()->json(['error' => 'Invalid date format, please use YYYY-MM-DD'], 400);
            }

            if ($start > $end) {
                return response()->json(['error' => 'Start date cannot be greater than end date'], 400);
            }

            $period = new DatePeriod(
            $start,
            new DateInterval('P1D'),
                $end->modify('+1 day')
            );

            foreach ($period as $date) {
                $dateRange[] = $date->format('Y-m-d');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing dates'], 400);
        }

        foreach ($dateRange as $date) {
            $response = $sheetDb->search(['Date' => $date]);
            $responseData = json_decode(json_encode($response), true);
            
            if (empty($responseData)) {
                return response()->json(['error' => 'No data found for date: ' . $date], 404);
            }
            
            $this->saveData($company->id, $responseData);
        }

        return response()->json(['message' => 'Data saved successfully']);
    }

    
    public function saveDataManualSelectedDate($companyName, $selectedDate) {
        set_time_limit(1800); // 30 Minutes
        
        $sheetDbApiKey = env('SHEETDB_API_KEY');
        $company = \DB::table('company')->where('name', $companyName)->first();
        $sheetDb = new SheetDB($sheetDbApiKey, $company->name);

        $arraySelectedDate = explode(',', $selectedDate);

        foreach ($arraySelectedDate as $date) {
            $response = $sheetDb->search(['Date' => $date]);
            $responseData = json_decode(json_encode($response), true);

            if (empty($responseData)) {
                return response()->json(['error' => 'No data found for date: ' . $date], 404);
            }
            
            $this->saveData($company->id, $responseData);
        }

        return response()->json(['message' => 'Data saved successfully']);
    }
}