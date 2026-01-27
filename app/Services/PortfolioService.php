<?php

namespace App\Services;

use App\Models\Project;

class PortfolioService
{
    public function getActive()
    {
        return Project::where('is_active', true)->orderBy('created_at', 'desc')->get();
    }

    public function featured()
    {
        return Project::where('is_active', true)->where('is_featured', true)->orderBy('created_at', 'desc')->get();
    }

    public function getAll()
    {
        return Project::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    public function delete(Project $project)
    {
        return $project->delete();
    }
}
