<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\PortfolioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct(protected PortfolioService $portfolioService) {}

    public function index()
    {
        $projects = $this->portfolioService->getAll();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
            'before_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'after_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('before_image')) {
            $data['before_image'] = $request->file('before_image')->store('portfolio', 'public');
        }

        if ($request->hasFile('after_image')) {
            $data['after_image'] = $request->file('after_image')->store('portfolio', 'public');
        }

        $this->portfolioService->create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('before_image')) {
            if ($project->before_image) {
                Storage::disk('public')->delete($project->before_image);
            }
            $data['before_image'] = $request->file('before_image')->store('portfolio', 'public');
        }

        if ($request->hasFile('after_image')) {
            if ($project->after_image) {
                Storage::disk('public')->delete($project->after_image);
            }
            $data['after_image'] = $request->file('after_image')->store('portfolio', 'public');
        }

        $this->portfolioService->update($project, $data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->before_image) {
            Storage::disk('public')->delete($project->before_image);
        }
        if ($project->after_image) {
            Storage::disk('public')->delete($project->after_image);
        }
        $this->portfolioService->delete($project);
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
