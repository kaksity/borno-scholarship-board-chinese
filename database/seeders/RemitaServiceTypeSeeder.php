<?php

namespace Database\Seeders;

use App\Models\RemitaServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemitaServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $remitaServiceTypes = [
            [
                'programme' => env('DEFAULT_SCHOLARSHIP_PROGRAMME'),
                'amount' => env('DEFAULT_APPLICANT_PAYMENT_AMOUNT'),
                'value' => env('REMITA_SERVICE_TYPE_ID'),
            ],
        ];

        DB::transaction(function() use ($remitaServiceTypes){
            foreach ($remitaServiceTypes as $remitaServiceType) {
                RemitaServiceType::create($remitaServiceType);
            }
        });
    }
}
