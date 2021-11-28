<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;




class ProjectController extends Controller
{


    public function index(Request $request)
    {
       // dd('dd');
        $projects = Project::when($request->search,function($q) use($request){

            return $q->whereTranslationLike('title','%'.$request->search.'%')
                     ->orWhereTranslationLike('content','%'.$request->search.'%');

        })->latest()->paginate(5);

        return view('dashboard.projects.index',compact('projects'));

    }


    public function create()
    {
        return view('dashboard.projects.create');
    }

    public function store(Request $request)
    {
        $rules=[];
        foreach (config('translatable.locales') as $locale) {

            //title ar or en are required and unique
            $rules +=[$locale.'.title' => ['required',Rule::unique('branch_translations','title')]];
        }

        $request->validate($rules);


        Project::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.projects.index');
    }


    public function edit(Project $project)
    {
        return view('dashboard.projects.edit',compact('project'));
    }


    public function update(Request $request, Project $project)
    {
        if($request->status == 'hide'){
            $project->status = 0;
            $project->update();
        }

        if($request->status == 'unhide'){
            $project->status = 1;
            $project->update();
        }

        $rules=[];
        foreach (config('translatable.locales') as $locale) {

            //name ar or en are required and unique and skip this id that selected
            $rules +=[$locale.'.title' => ['required',Rule::unique('branch_translations','title')->ignore($branch->id,'branch_id')]];
        }
        $request->validate($rules);

        $project->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.projects.index');
    }




}
