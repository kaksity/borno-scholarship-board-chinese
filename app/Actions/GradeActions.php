<?php

namespace App\Actions;

use App\Models\Grade;

class GradeActions
{
    public function __construct(
        private Grade $grade
    )
    {}

    public function listGrades()
    {
        return $this->grade->get();
    }
}
