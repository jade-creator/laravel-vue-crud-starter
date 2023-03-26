<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PhilippineStandardGeographicCodeSeeder extends Seeder
{
    private function booleanFalseToNullColumnValue(string $key = "", array $data = [])
    {

        if (isset($data[$key])
                && $data[$key] === false) $data[$key] = null;

        return $data;
    }

    private function addTimestamps(array $data = [])
    {
        foreach ($data as $key => $value) {
            $data[$key]["created_at"] = now();
            $data[$key]["updated_at"] = now();
        }

        return $data;
    }

    private function convertJsonToArray(string $url = "")
    {
        $data = json_decode(file_get_contents($url), true);

        $data = $this->addTimestamps($data);

        foreach ($data as $key => $value) {
            $data[$key];
        }

        $data = array_map(function ($value) {
            return $this->booleanFalseToNullColumnValue("districtCode", $value);
        }, $data);

        return $data;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment('Seeding Philippine Standard Geographic Codes...');

        // regions
        DB::table('regions')->truncate();

        $regions = $this->convertJsonToArray(public_path('psgc/regions.json'));

        DB::table('regions')->insert($regions);

        //provinces
        DB::table('provinces')->truncate();

        $provinces = $this->convertJsonToArray(public_path('psgc/provinces.json'));

        DB::table('provinces')->insert($provinces);

        //districts
        DB::table('districts')->truncate();

        $cities = $this->convertJsonToArray(public_path('psgc/cities.json'));
        $municipalities = $this->convertJsonToArray(public_path('psgc/municipalities.json'));
        $districts = array_merge($cities, $municipalities);

        foreach (array_chunk($districts, 500) as $data)
        {
            DB::table('districts')->insert($data);
        }

        // //cities
        // DB::table('cities')->truncate();

        // $cities = $this->convertJsonToArray(public_path('psgc/cities.json'));

        // DB::table('cities')->insert($cities);

        // //municipalities
        // DB::table('municipalities')->truncate();

        // $municipalities = $this->convertJsonToArray(public_path('psgc/municipalities.json'));

        // DB::table('municipalities')->insert($municipalities);

        //barangays
        DB::table('barangays')->truncate();

        $barangays = $this->convertJsonToArray(public_path('psgc/barangays.json'));

        foreach (array_chunk($barangays, 500) as $data)
        {
             DB::table('barangays')->insert($data);
        }
    }
}
