<?php

namespace App\Service\Database;

use App\Models\School;

class SchoolService{

    public function detail($schoolId)
    {
        $school = School::findOrFail($schoolId);

        return $school->toArray();
    }

}
