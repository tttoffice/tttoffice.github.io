<?php

namespace App\Http\Controllers\Dashboard;

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
use App\Mail\ReplyTicket;
use App\Mail\CloseTicket;

use App\Models\Media;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;


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
        $modules=Module::all();
        $tickets=Ticket::where('user_id',Auth::id())->paginate(10);
        return view('dashboard.tickets.index',compact(['tickets','modules']));
    }

    public function pendingcalls(Request $request)
    {
        $tickets=Ticket::where('user_id',Auth::id())
                        ->where(function ($query)  {
                            $query->where('is_logged',1)
                                  ->orwhere('is_pending',1);
                        })->paginate(10);

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


        if ($request->hasFile('file1')) {
            // storeMedia($request->file1, 'tickets/'.Auth::user()->email.'/ticket('.$ticket->id.')', $ticket->id, 'App\Models\Ticket');
            storeMedia($request->file1, 'tickets/ticket('.$ticket->id.')', $ticket->id, 'App\Models\Ticket');
        }

        if ($request->hasFile('file2')) {
            // storeMedia($request->file2, 'tickets/'.Auth::user()->email.'/ticket('.$ticket->id.')', $ticket->id, 'App\Models\Ticket');
            storeMedia($request->file2, 'tickets/ticket('.$ticket->id.')', $ticket->id, 'App\Models\Ticket');
        }

        $data = array(
                'call_no'=>$ticket->id,
                'user_firstName'=>Auth::user()->firstName,
                'user_lastName'=>Auth::user()->lastName,
                'title'=>$ticket->title,
                'description'=>$ticket->description,
                'status'=>$ticket->status
        );

         $emails = [Auth::user()->email,'khaled.ghonaim@albargasy.com'];
         try {
            Mail::to($emails)->send(new TicketDetails($data));
         } catch (\Exception $e) {
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.tickets.index');
         }

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.tickets.index');
    }//end of store ticket


    //editor side
    public function allcalls(Request $request)
    {
        $modules=Module::all();
        $tickets=Ticket::paginate(10);
        return view('dashboard.tickets.allcalls',compact(['tickets','modules']));
    }

    public function allpendingcalls(Request $request)
    {
        $modules=Module::all();
        $tickets=Ticket::where('is_logged',1)
                        ->orwhere('is_pending',1)->paginate(10);
        return view('dashboard.tickets.allpendingcalls',compact(['tickets','modules']));
    }

    public function allcloasedcalls(Request $request)
    {
        $modules=Module::all();
        $tickets=Ticket::where('is_solved',1)->paginate(10);
        return view('dashboard.tickets.allcloasedcalls',compact(['tickets','modules']));
    }


    public function update(Ticket $ticket,Request $request)
    {

        if($request->is_solved)
        {
                $ticket->update([
                    'is_solved'=>$request->is_solved,
                    'status'=>'solved',
                    'closedBy_id'=>Auth::user()->id,
                    'is_logged'=>0,
                    'is_pending'=>0

                    ]);

                $data = array(
                    'call_no'=>$ticket->id,
                    'user_firstName'=>$ticket->user->firstName,
                    'user_lastName'=>$ticket->user->lastName,
                    'status'=>$ticket->status,

                );

                $emails = [$ticket->user->email,'khaled.ghonaim@albargasy.com'];
                 try {
                    Mail::to($emails)->send(new CloseTicket($data));

                 } catch (\Exception $e) {

                    session()->flash('success', __('site.added_successfully'));
                    return redirect()->route('dashboard.allpendingcalls');
                 }

                session()->flash('success', __('site.updated_successfully'));
                return redirect()->route('dashboard.allpendingcalls');
        }

        if($request->external_ticket_id)
        {
            $ticket->update([
                'external_ticket_id'=>$request->external_ticket_id,
                'status'=>'withSupport',
                'is_logged'=>0,
                'is_pending'=>1,
                ]);

            session()->flash('success', __('site.updated_successfully'));
            return redirect()->route('dashboard.allpendingcalls');
            // dd($ticket);
        }

        //editor or employeee
         if($request->reply)
         {
            $ticket->users()->attach(Auth::id(),['reply'=>$request->reply]);

            $data = array(
                'call_no'=>$ticket->id,
                'user_firstName'=>Auth::user()->firstName,
                'user_lastName'=>Auth::user()->lastName,
                'reply'=>$request->reply,

            );

            $emails = [$ticket->user->email,'khaled.ghonaim@albargasy.com'];

             if ($request->hasFile('file_reply')) {
                // storeMedia($request->file_reply, 'tickets/'.$ticket->user->email.'/ticket('.$ticket->id.')', $ticket->id, 'App\Models\Ticket');
                storeMedia($request->file_reply, 'tickets/ticket('.$ticket->id.')', $ticket->id, 'App\Models\Ticket');
             }

             try {
                Mail::to($emails)->send(new ReplyTicket($data));
                //Mail::to(Auth::user()->email)->send(new ReplyTicket($data));
             } catch (\Exception $e) {

                session()->flash('success', __('site.added_successfully'));
                return redirect()->route('dashboard.tickets.index');
             }

             session()->flash('success', __('site.updated_successfully'));

             if(Auth::user()->isAn('super_admin') || Auth::user()->isAn('editor') ){

              $ticket->update([
                  'status'=>'withSupport',
                  'is_logged'=>0,
                  'is_pending'=>1,
                  ]);

              return redirect()->route('dashboard.allpendingcalls');
             }else{//if user is employee

              $ticket->update([
                  'status'=>'withCustomer',
                  ]);

               return redirect()->route('dashboard.pendingcalls');
             }

         }

    }//end of update


    public function export(Request $request)
    {

        if($request->module_id)
        {
            $tickets = Ticket::where('module_id',$request->module_id)->get();
        }else{
            $tickets = Ticket::all();
        }

        $stack=[];
        foreach ($tickets as $ticket) {
            $employee_fullName =$ticket->user->firstName.' '.$ticket->user->lastName;

            $created_at_format =is_null($ticket->created_at) ?'':$ticket->created_at->toDayDateTimeString();
            if($ticket->is_solved == 1)
            {
                $closedBy_fullName =$ticket->closedBy->firstName.' '.$ticket->closedBy->lastName;
                $closed_at_format =is_null($ticket->updated_at) && $ticket->status == 'solved'?'':$ticket->updated_at->toDayDateTimeString();
            }else{
                $closedBy_fullName = 'Not yet';
                $closed_at_format = '';
            }

            array_push($stack,[$ticket->id,$employee_fullName,$ticket->module->title ,$ticket->title,$ticket->description,$created_at_format,$ticket->status, $closedBy_fullName,$closed_at_format]);
        }

     //  dd($stack);

        $export = new TicketsExport([$stack]);

        return Excel::download($export, 'tickets.xlsx');
    }

}
