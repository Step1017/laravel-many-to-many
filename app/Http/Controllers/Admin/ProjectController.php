<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//Importazione Models:
use App\Models\Project;
use App\Models\Type;

//Importazione Requests:
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

//Importazione Helpers:
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

//Importazione Mails:
use App\Mail\NewProject;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects')); 
        /*Puoi farlo anche con array associativo ovvero:
        return view('admin.projects.index', [
            'projects'=> $projects,
        ]);*/
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        
        // $slug = Str::slug($data['title']);
        // dd($slug);
        
        // $newProject = Project::create([
            //     'title' => $data['title'],
            //     'slug' => $slug,
            //     'description' => $data['description'],
            //     'link' => $data['link'],
            //     'preview' =>$data['preview']
            // ]);
            
            //--------- ALTERNATIVA ----------
            
        $data = $request->validated();
        
        if (array_key_exists('image', $data)) {
            $imagePath = Storage::put('uploads', $data['image']);
            $data['image'] = $imagePath;
        } 

        $data['slug'] = Str::slug($data['title']);

        $newProject = Project::create($data);

        Mail::to('stefania@classe84.com')->send(new NewProject($newProject));

        return redirect()->route('admin.projects.show', $newProject->id)->with('success', 'Progetto aggiunto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
        /*Puoi farlo anche con array associativo ovvero:
        return view('admin.projects.show', [
            'project'=> $project,
        ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if(array_key_exists('delete_img', $data)) {
            if ($project->image) {
                Storage::delete($project->image);

                $project->image = null;
                $project->save();
            }
        }

        else if (array_key_exists('image', $data)) {
            $imagePath = Storage::put('uploads', $data['image']);
            $data['image'] = $imagePath;

            if ($project->image) {
                Storage::delete($project->image);
            }
        } 
        

        $data['slug'] = Str::slug($data['title']);

        $project->update($data);

        return redirect()->route('admin.projects.show', $project->id)->with('success', 'Progetto aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo!');
    }
}