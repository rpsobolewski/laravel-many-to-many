<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use function PHPUnit\Framework\isNull;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {


        $valData = $request->validated();

        $valData['slug'] = Str::slug($request->title, '-');

        if ($request->has('thumb')) {
            $file_path = Storage::put('projectImages', $request->thumb);
            $valData['thumb'] = $file_path;
        }



        $newProject = Project::create($valData);

        $newProject->technologies()->attach($request->technologies);

        return to_route('admin.projects.index')->with('status', 'Well Done, New Entry Added Succeffully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)

    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $valData = $request->validated();

        $valData['slug'] = Str::slug($request->title, '-');

        if ($request->has('thumb')) {
            if (!isNull($project->thumb) && Storage::fileExists($project->thumb)) {

                Storage::delete($project->thumb);
            }

            $newThumb = $request->thumb;
            $path = Storage::put('projectImages', $newThumb);

            $valData['thumb'] = $path;
        }
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        $project->update($valData);
        return to_route('admin.projects.show', $project->slug)->with('status', 'Well Done, Element Edited Succeffully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if (Storage::exists($project->thumb)) {

            Storage::delete($project->thumb);
        }
        $project->technologies()->detach();

        $project->delete();




        return to_route('admin.projects.index')->with('message', 'Well Done, Element Deleted Succeffully');
    }
}
