<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;




class ModuleController extends Controller
{


    public function index(Request $request)
    {
       // dd('dd');
        $modules = Module::when($request->search,function($q) use($request){

            return $q->whereTranslationLike('title','%'.$request->search.'%')
                     ->orWhereTranslationLike('content','%'.$request->search.'%');

        })->latest()->paginate(5);

        return view('dashboard.modules.index',compact('modules'));

    }


    public function create()
    {
        return view('dashboard.modules.create');
    }

    public function store(Request $request)
    {
        $rules=[];
        foreach (config('translatable.locales') as $locale) {

            //title ar or en are required and unique
            $rules +=[$locale.'.title' => ['required',Rule::unique('module_translations','title')]];
        }

        $request->validate($rules);


        Module::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.modules.index');
    }


    public function edit(Module $module)
    {
        return view('dashboard.modules.edit',compact('module'));
    }


    public function update(Request $request, Module $module)
    {
        if($request->status == 'hide'){
            $module->status = 0;
            $module->update();
        }

        if($request->status == 'unhide'){
            $module->status = 1;
            $module->update();
        }

        $rules=[];
        foreach (config('translatable.locales') as $locale) {

            //name ar or en are required and unique and skip this id that selected
            $rules +=[$locale.'.title' => ['required',Rule::unique('module_translations','title')->ignore($module->id,'module_id')]];
        }
        $request->validate($rules);

        $module->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.modules.index');
    }



}
