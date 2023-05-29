<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        $this->validation($request);
        //$this->validation($formData);

        $newProject = new Project();

        //test immagine
        if ($request->hasFile('cover_image')) {

            $path = Storage::put('project_images', $request->cover_image);

            $formData['cover_image'] = $path;
        }
        //fine test

        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->title, '-');

        $newProject->save();

        if (array_key_exists('technologies', $formData)) {

            $newProject->technologies()->attach($formData['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $formData = $request->all();
        $this->validation($request);

        $project->slug = Str::slug($formData['title'], '-');
        // test img

        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {

                Storage::delete($project->cover_image);
            }

            $path = Storage::put('project_images', $request->cover_image);

            $formData['cover_image'] = $path;
        }


        // fine test



        $project->update($formData);
        // in teoria il save dovrebbe essere automatico ma alcune versioni di laravel lo vogliono
        $project->save();

        if (array_key_exists('technologies', $formData)) {

            $project->technologies()->sync($formData['technologies']);
        } else {

            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validation($request)
    {

        $formData = $request->all();

        $validator = Validator::make($formData, [

            'title' => 'required|max:100|min:6',
            'content' => 'required|min:40',
            'type_id' => 'nullable|exists:types,id',

            'technologies' => 'exists:technologies,id',
            'cover_image' => 'nullable|image|max:5000',

        ], [

            'title.required' => "E' necessario inserire un titolo",
            'title.max' => 'Il titolo non deve superare :max caratteri',
            'title.min' => 'Il titolo deve avere un minimo di 6 caratteri',
            'content.required' => "E' richiesta una descrizione",
            'content.max' => 'La descrizione deve avere un minimo di :min caratteri',
            'type_id.exists' => 'La tipologia deve essere inserita',
            'technologies.exists' => 'La tecnologia usata deve essere inserita',
            'cover_image.image' => 'Inserire un file immagine',
            'cover_image.max' => 'File img troppo grande',

        ])->validate();

        return $validator;
    }
}
