<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workflow;
use App\Services\WorkflowService;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function __construct(protected WorkflowService $workflowService) {}

    public function index()
    {
        $workflows = $this->workflowService->getAll();
        return view('admin.workflow.index', compact('workflows'));
    }

    public function create()
    {
        return view('admin.workflow.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'step_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $this->workflowService->create($data);

        return redirect()->route('admin.workflow.index')->with('success', 'Workflow step created successfully.');
    }

    public function edit(Workflow $workflow)
    {
        return view('admin.workflow.edit', compact('workflow'));
    }

    public function update(Request $request, Workflow $workflow)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'step_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $this->workflowService->update($workflow, $data);

        return redirect()->route('admin.workflow.index')->with('success', 'Workflow step updated successfully.');
    }

    public function destroy(Workflow $workflow)
    {
        $this->workflowService->delete($workflow);
        return redirect()->route('admin.workflow.index')->with('success', 'Workflow step deleted successfully.');
    }
}
