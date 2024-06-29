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
                'programme' => 'Undergraduate',
                'amount' => '825',
                'value' => '7190990581',
            ],
            [
                'programme' => 'Diploma',
                'amount' => '550',
                'value' => '7191082859',
            ],
            [
                'programme' => 'HND',
                'amount' => '550',
                'value' => '7191082859',
            ],
            [
                'programme' => 'NCE',
                'amount' => '550',
                'value' => '7191082859',
            ],
            [
                'programme' => 'Nursing',
                'amount' => '550',
                'value' => '7191082859',
            ],
        ];

        DB::transaction(function() use ($remitaServiceTypes){
            foreach ($remitaServiceTypes as $remitaServiceType) {
                RemitaServiceType::create($remitaServiceType);
            }
        });
    }
}
