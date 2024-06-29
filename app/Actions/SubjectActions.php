<?php

namespace App\Actions;

use App\Models\Subject;

class SubjectActions
{
    public function __construct(
        private Subject $subject
    )
    {}

    public function listSubjects()
    {
        return $this->subject->get();
    }
}
