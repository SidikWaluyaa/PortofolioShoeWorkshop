<?php

namespace App\Services;

use App\Models\Workflow;

class WorkflowService
{
    public function getActive()
    {
        return Workflow::where('is_active', true)->orderBy('step_order')->get();
    }

    public function getAll()
    {
        return Workflow::orderBy('step_order')->get();
    }

    public function create(array $data)
    {
        return Workflow::create($data);
    }

    public function update(Workflow $workflow, array $data)
    {
        $workflow->update($data);
        return $workflow;
    }

    public function delete(Workflow $workflow)
    {
        return $workflow->delete();
    }
}
