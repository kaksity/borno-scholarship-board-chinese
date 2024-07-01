<?php

namespace App\Actions;

use App\Models\CourseOfStudy;

class CourseOfStudyActions
{
    public function __construct(
        private CourseOfStudy $courseOfStudy
    )
    {}

    public function getCourseOfStudyById($id, $relationships = [])
    {
        return $this->courseOfStudy->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function listCourseOfStudies($relationships = [])
    {
        return $this->courseOfStudy->with($relationships)->get();
    }
}
