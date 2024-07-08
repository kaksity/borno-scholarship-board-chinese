<?php

namespace Database\Seeders;

use App\Models\CourseOfStudy;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseOfStudySubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseOfStudies = [
            [
                'name' => 'Engineering',
                'subjects' => [
                    'Mathematics',
                    'English',
                    'Physics',
                    'Chemistry',
                    'Biology',
                ]
            ],
            [
                'name' => 'Medicine',
                'subjects' => [
                    'Mathematics',
                    'English',
                    'Physics',
                    'Chemistry',
                    'Biology',
                ]
            ],
            [
                'name' => 'Chinese Language',
                'subjects' => [
                    'Mathematics',
                    'English',
                    'Literature',
                    'Government',
                    'Hausa',
                ]
            ],
        ];

        DB::transaction(function () use ($courseOfStudies) {
            foreach ($courseOfStudies as $courseOfStudy) {
                $subjectIds = Subject::whereIn('name', $courseOfStudy['subjects'])->get()->pluck('id');
                $course = CourseOfStudy::where('name', $courseOfStudy)->first();
                $course->subjects()->sync($subjectIds);
            }
        });
    }
}
