<?php

namespace App\Http\Controllers\Portal;

use App\Models\Ticket;
use App\Models\Branch;
use App\Models\Module;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use App\Mail\TicketDetails;


class TicketController extends Controller
{

//employees side
    public function search(Request $request)
    {

            $branches=Branch::all();
            $modules=Module::all();
            $projects=Project::all();

            $tickets=Ticket::where('user_id',Auth::id())->when($request->search,function($q) use($request){

                return $q->whereLike('title','%'.$request->search.'%')
                        ->orWhereLike('description','%'.$request->search.'%');

            })->when($request->branch_id,function($q) use($request){

                return $q->where('branch_id',$request->branch_id);

            })->when($request->module_id,function($q) use($request){

                return $q->where('module_id',$request->module_id);

            })->paginate(10);

            return view('dashboard.tickets.search',compact('tickets','branches','modules','projects'));
    }


    public function index(Request $request)
    {
        $tickets=Ticket::where('user_id',Auth::id())->paginate(10);
        return view('dashboard.tickets.index',compact('tickets'));
    }

    public function pendingcalls(Request $request)
    {
        $tickets=Ticket::where('user_id',Auth::id())
                        ->where('is_logged',1)
                        ->orwhere('is_pending',1)->paginate(10);

        return view('dashboard.tickets.pendingcalls',compact('tickets'));
    }//done

    public function cloasedcalls(Request $request)
    {
        $tickets=Ticket::where('user_id',Auth::id())->where('is_solved',1)->paginate(10);
        return view('dashboard.tickets.index',compact('tickets'));
    }


    public function show($id)
    {
       $ticket = Ticket::find($id);

          return view('dashboard.tickets.show')->with('ticket',$ticket);


    }





    public function create()
    {
        $branches= Branch::all();
        $modules= Module::all();
        $projects=Project::all();

        return view('dashboard.tickets.create',compact('branches','modules','projects'));
    }




    public function store(Request $request)
    {

        $request->validate([
            'module_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'priority'=>'required',
        ]);

        $ticket=Ticket::create([

            'user_id'=>Auth::id(),
            'project_id'=>Auth::user()->project_id,
            'branch_id'=>Auth::user()->branch_id,
            'module_id'=>$request->module_id,


            'title'=>$request->title,
            'description'=>$request->description,
            'priority'=>$request->priority,
            'reference_call'=>$request->reference_call,
            'status'=>'logged',

        ]);

       /* $data = array(
            'call_no'=>$ticket->id,
            'user_firstName'=>Auth::user()->firstName,
            'user_lastName'=>Auth::user()->lastName,
            'title'=>$ticket->title,
            'description'=>$ticket->description,
            'status'=>$ticket->status
        );

        $ticket_id=$ticket->id;
        $user_email=$ticket->user->email;

        Mail::send('emails.SendTicketDetails', $data, function($message) use ($ticket_id, $user_email)
        {
            $message->to($user_email, 'Mohamed Morsy')->subject('new Ticket('.$ticket_id.')');
        });*/ //worked but without compoentat



            $data = array(
                'call_no'=>$ticket->id,
                'user_firstName'=>Auth::user()->firstName,
                'user_lastName'=>Auth::user()->lastName,
                'title'=>$ticket->title,
                'description'=>$ticket->description,
                'status'=>$ticket->status
            );


         Mail::to($ticket->user->email)->send(new TicketDetails($data));



        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.tickets.index');
    }


    //editor side
    public function allcalls(Request $request)
    {
        $tickets=Ticket::paginate(10);
        return view('dashboard.tickets.allcalls',compact('tickets'));
    }

    public function allpendingcalls(Request $request)
    {
        $tickets=Ticket::where('is_logged',1)
                        ->orwhere('is_pending',1)->paginate(10);
        return view('dashboard.tickets.allpendingcalls',compact('tickets'));
    }

    public function allcloasedcalls(Request $request)
    {
        $tickets=Ticket::where('is_solved',1)->paginate(10);
        return view('dashboard.tickets.allcloasedcalls',compact('tickets'));
    }


    public function update(Ticket $ticket,Request $request)
    {
       $ticket->update([
           'is_solved'=>$request->is_solved,
           'status'=>'solved',
           'is_logged'=>0
           ]);

       session()->flash('success', __('site.updated_successfully'));

       return redirect()->route('dashboard.allcloasedcalls');


    }

}
