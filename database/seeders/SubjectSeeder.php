<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Mathematics'],
            ['name' => 'English'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Biology'],
            ['name' => 'Literature'],
            ['name' => 'Government'],
            ['name' => 'Hausa'],
        ];

        DB::transaction(function () use ($subjects) {
            foreach ($subjects as $subject) {
                Subject::create($subject);
            }
        });
    }
}
