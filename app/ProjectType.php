<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    public function getProjectTypeList(){
        $project_type = ProjectType::query();

        $projectTypeData = $project_type->orderBy('project_type_name','ASC')->distinct()->get()->toArray();

        return $projectTypeData;
    }
}
