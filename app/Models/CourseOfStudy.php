<?php

namespace App\Models;

class CourseOfStudy extends AbstractModel
{
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_of_study_subjects');
    }

}
