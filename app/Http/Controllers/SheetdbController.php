<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;

class SheetDbController extends Controller
{
    public function get() {
        $sheetdb = new SheetDB('oyq0u84zkxyt5', 'WTC Company');

        // dd($sheetdb->get());
        // dd($sheetdb->keys());
        // dd($sheetdb->name());
    
        return $sheetdb->get();
        
    }

    public function saveData($companyId, $responseData) {

        // SAVE DATA ANORGANIC
        if (!empty($responseData)) {
            foreach ($responseData as $data) {
            $existingRecord = \DB::table('tbl_anorganic_recap')
                ->where('date', $data['Date'])
                ->where('company_id', $companyId)
                ->first();

                if ($existingRecord) {
                    \DB::table('tbl_anorganic_recap')
                    ->where('date', $data['Date'])
                    ->where('company_id', $companyId)
                    ->update([
                        'plastic_ldpe' => !empty($data['Plastic LDPE']) ? $data['Plastic LDPE'] : null,
                        'plastic_hdpe' => !empty($data['Plastic HDPE']) ? $data['Plastic HDPE'] : null,
                        'plastic_pet' => !empty($data['Plastic PET']) ? $data['Plastic PET'] : null,
                        'plastic_pp' => !empty($data['Plastic PP']) ? $data['Plastic PP'] : null,
                        'beling' => !empty($data['Beling']) ? $data['Beling'] : null,
                        'aluminium' => !empty($data['Aluminium']) ? $data['Aluminium'] : null,
                        'besi' => !empty($data['Besi']) ? $data['Besi'] : null,
                        'kaleng' => !empty($data['Kaleng']) ? $data['Kaleng'] : null,
                        'kertas' => !empty($data['Kertas']) ? $data['Kertas'] : null,
                        'kardus' => !empty($data['Kardus']) ? $data['Kardus'] : null,
                        'gabruk' => !empty($data['Gabruk']) ? $data['Gabruk'] : null,
                        'total_data_daily' => !empty($data['Total Data Anorganik Harian']) ? $data['Total Data Anorganik Harian'] : null,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                    // echo 'Data updated successfully';
                    return response()->json(['message' => 'Data updated successfully']);
                } else {
                    \DB::table('tbl_anorganic_recap')->insert([
                    'date' => $data['Date'],
                    'company_id' => $companyId,
                    'plastic_ldpe' => !empty($data['Plastic LDPE']) ? $data['Plastic LDPE'] : null,
                    'plastic_hdpe' => !empty($data['Plastic HDPE']) ? $data['Plastic HDPE'] : null,
                    'plastic_pet' => !empty($data['Plastic PET']) ? $data['Plastic PET'] : null,
                    'plastic_pp' => !empty($data['Plastic PP']) ? $data['Plastic PP'] : null,
                    'beling' => !empty($data['Beling']) ? $data['Beling'] : null,
                    'aluminium' => !empty($data['Aluminium']) ? $data['Aluminium'] : null,
                    'besi' => !empty($data['Besi']) ? $data['Besi'] : null,
                    'kaleng' => !empty($data['Kaleng']) ? $data['Kaleng'] : null,
                    'kertas' => !empty($data['Kertas']) ? $data['Kertas'] : null,
                    'kardus' => !empty($data['Kardus']) ? $data['Kardus'] : null,
                    'gabruk' => !empty($data['Gabruk']) ? $data['Gabruk'] : null,
                    'total_data_daily' => !empty($data['Total Data Anorganik Harian']) ? $data['Total Data Anorganik Harian'] : null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                    // echo 'Data saved successfully';
                    return response()->json(['message' => 'Data saved successfully']);
                }
            }
        } else {
            // echo 'No data found';
            return response()->json(['message' => 'No data found']);
        }
    }

    public function saveDataAllCompany() {
        $date = date('Y-m-d');
        $companies = \DB::table('company')->get();
        
        foreach ($companies as $company) {
            $sheetDb = new SheetDB('oyq0u84zkxyt5', $company->name);
            
            if (!empty($sheetDb->get())) {
                $response = $sheetDb->search(['Date' => $date]);
                $responseData = json_decode(json_encode($response), true);

                $this->saveData($company->id, $responseData);
            }
        }

        // $sheetDb = new SheetDB('oyq0u84zkxyt5', 'WTC Company');
        // $response = $sheetDb->search(['Date' => $date]);
        // $responseData = json_decode(json_encode($response), true);
        // $this->saveData(2, $responseData);
    }
}