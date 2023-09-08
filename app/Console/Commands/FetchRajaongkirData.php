<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchRajaongkirData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:rajaongkir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Province data from API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        if (env('RAJAONGKIR_API_KEY') == null || env('RAJAONGKIR_API_KEY') == "") {
            throw new \Error("Error env var RAJAONGKIR_API_KEY");
        }
        $apiKey = env('RAJAONGKIR_API_KEY');
        $responseProvince = $client->get('https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => $apiKey
            ]
        ]);

        $provinces = json_decode($responseProvince->getBody(), true);
        $this->seedProvinces($provinces);

        $responseCities = $client->get('https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => $apiKey
            ]
        ]);

        $cities = json_decode($responseCities->getBody(), true);
        $this->seedCities($cities);

        return Command::SUCCESS;
    }

    private function seedProvinces($provinces) {
        $provinceNames = array_column($provinces['rajaongkir']['results'], 'province');
        foreach ($provinceNames as $provinceName) {
            DB::table('provinces')->updateOrInsert(
                ['name' => $provinceName]
            );
        }
    }
    private function seedCities($cities) {
        $cityData = $cities['rajaongkir']['results'];
        foreach ($cityData as $cityDatum) {
            DB::table('cities')->updateOrInsert(
                [
                    'name' => $cityDatum['city_name'],
                    'province_id' => $cityDatum['province_id'],
                ],
                [
                    'name' => $cityDatum['city_name'],
                    'province_id' => $cityDatum['province_id'],
                    'type' => $cityDatum['type'],
                    'postal_code' => $cityDatum['postal_code'],
                ]
            );
        }
    }
}
