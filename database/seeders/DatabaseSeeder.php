<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CourseOfStudySeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(CourseOfStudySubjectSeeder::class);
        $this->call(LgaSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(RemitaServiceTypeSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
