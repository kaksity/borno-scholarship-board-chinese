<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'name' => 'A1',
                'grade' => 90
            ],
            [
                'name' => 'B2',
                'grade' => 77
            ],
            [
                'name' => 'B3',
                'grade' => 72
            ],
            [
                'name' => 'C4',
                'grade' => 67
            ],
            [
                'name' => 'C5',
                'grade' => 62
            ],
            [
                'name' => 'C6',
                'grade' => 57
            ],
        ];

        DB::transaction(function () use ($grades) {
            foreach ($grades as $grade) {
                Grade::create($grade);
            }
        });
    }
}
