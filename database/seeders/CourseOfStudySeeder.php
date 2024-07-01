<?php

namespace Database\Seeders;

use App\Models\CourseOfStudy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseOfStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseOfStudies = [
            [
                'name' => 'Engineering',
                'minimum_points' => 60
            ],
            [
                'name' => 'Medicine',
                'minimum_points' => 75
            ],
        ];

        DB::transaction(function () use ($courseOfStudies) {
            foreach ($courseOfStudies as $courseOfStudy) {
                CourseOfStudy::create($courseOfStudy);
            }
        });
    }
}
