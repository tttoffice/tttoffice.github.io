<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;




class BranchController extends Controller
{


    public function index(Request $request)
    {
       // dd('dd');
        $branches = Branch::when($request->search,function($q) use($request){

            return $q->whereTranslationLike('title','%'.$request->search.'%')
                     ->orWhereTranslationLike('content','%'.$request->search.'%');

        })->latest()->paginate(5);

        return view('dashboard.branches.index',compact('branches'));

    }


    public function create()
    {
        return view('dashboard.branches.create');
    }

    public function store(Request $request)
    {
        $rules=[];
        foreach (config('translatable.locales') as $locale) {

            //title ar or en are required and unique
            $rules +=[$locale.'.title' => ['required',Rule::unique('branch_translations','title')]];
        }

        $request->validate($rules);


        Branch::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.branches.index');
    }


    public function edit(Branch $branch)
    {
        return view('dashboard.branches.edit',compact('branch'));
    }


    public function update(Request $request, Branch $branch)
    {
        if($request->status == 'hide'){
            $branch->status = 0;
            $branch->update();
        }

        if($request->status == 'unhide'){
            $branch->status = 1;
            $branch->update();
        }

        $rules=[];
        foreach (config('translatable.locales') as $locale) {

            //name ar or en are required and unique and skip this id that selected
            $rules +=[$locale.'.title' => ['required',Rule::unique('branch_translations','title')->ignore($branch->id,'branch_id')]];
        }
        $request->validate($rules);

        $branch->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.branches.index');
    }



}
