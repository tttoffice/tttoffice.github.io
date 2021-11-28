@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.tickets')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}"> <i class="fa fa-dashboard">     </i> @lang('site.dashboard') </a> </li>
        <li> <a href="{{  route('dashboard.tickets.index') }}">  @lang('site.tickets') </a> </li>
        <li class="active">   </i> @lang('site.show')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                <h3 class="box-title">@lang('site.show')</h3>

            </div>
            <div class="box-body">
                @include('partials._errors')


                    <div class="form-group">
                        <label> @lang('site.code') </label>
                        <input type="text" disabled class="form-control" value="{{ $ticket->id }} ">
                    </div>

                    <div class="form-group">
                        <label> @lang('site.branchName') </label>
                        <input type="text" disabled class="form-control" value="{{ $ticket->branch->title }} ">
                    </div>

                    <div class="form-group">
                        <label> @lang('site.fullname') </label>
                        <input type="text" disabled class="form-control" value="{{ $ticket->user->firstName ?? "" }} {{ $ticket->user->lastName ?? ""}} ">
                    </div>
                    <div class="form-group">
                        <label> @lang('site.email') </label>
                        <input type="text" disabled class="form-control" value="{{ $ticket->user->email ?? "" }} ">
                    </div>







                    <div class="form-group">
                        <label > @lang('site.priorities') </label>
                        <select name="priority" disabled class="form-control" >
                                <option  value="{{$ticket->priority}}">
                                    @switch($ticket->priority)
                                        @case('low')
                                            @lang('site.low')
                                            @break

                                        @case('medium')
                                            @lang('site.medium')
                                            @break

                                        @default
                                        @lang('site.high')
                                    @endswitch
                             </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label> @lang('site.reference_call') </label>
                        <input type="text" name="reference_call"  disabled class="form-control" value="{{ old('reference_call') }} ">
                    </div>

                    <div class="form-group">
                        <label> @lang('site.status') </label>
                        <input type="text" disabled class="form-control" value="{{ $ticket->status ?? "" }} ">
                    </div>

                    <div class="form-group">
                        <label> @lang('site.closed_at') </label>
                        <input type="text" disabled class="form-control" value="{{ $ticket->status == 'solved' ? $ticket->updated_at : '' }} ">
                    </div>





                    <div class="form-group">

                        <div class="nav-tabs-custom">
                            @php
                                $models=['TicketDetails','Attachments','Replies'];

                            @endphp
                            <ul class="nav nav-tabs">

                                @foreach ($models as $index=>$model)
                                   <li class="{{ $index == 0 ? 'active' : '' }}"> <a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a> </li>
                                @endforeach


                            </ul>


                            <div class="tab-content">

                                    <div class="tab-pane active " id="TicketDetails">

                                        <div class="form-group">
                                            <label> @lang('site.title') </label>
                                            <input type="text" disabled name="title" class="form-control" value="{{$ticket->title}}" >
                                        </div>

                                        <div class="form-group">
                                            <label> @lang('site.description') </label>

                                            <textarea name="description" disabled class="form-control" cols="30" rows="10"   >{{$ticket->description}}</textarea>
                                        </div>

                                    </div>

                                    <div class="tab-pane  " id="Attachments">

                                        <label> @lang('site.files') </label>
                                        <br>
                                        @if ($ticket->medias->count() > 0)

                                            @foreach ( $ticket->medias as $index=>$file )
                                            {{-- <strong>File {{ $index+1}}</strong>  <a href="{{asset('uploads/tickets/'.$ticket->user->email.'/ticket('.$ticket->id.')/'.$file->file)}}">{{$file->file}}</a> --}}
                                            <strong>File {{ $index+1}}</strong>  <a href="{{asset('uploads/tickets/ticket('.$ticket->id.')/'.$file->file)}}">{{$file->file}}</a>
                                            <br>
                                            @endforeach

                                        @else
                                         <h2>@lang('site.no_file_uploaded')</h2>
                                        @endif



                                    </div>


                                    <div class="tab-pane  " id="Replies">


                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <h4>@lang('site.Replies')</h4>

                                                        @foreach ($ticket->users as $index=>$user )
                                                        <strong>{{$user->pivot->created_at ? $user->pivot->created_at->toDayDateTimeString() : "" }}  - {{$user->firstName}} {{$user->lastName}} </strong> <br>
                                                        <strong>  {{$user->pivot->reply}}</strong> <br>
                                                        <hr>

                                                        @endforeach
                                                        <hr />

                                                        @if ($ticket->status != 'solved')
                                                            <h4>@lang('site.add_reply')</h4>
                                                            <form action="{{route('dashboard.tickets.update', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                {{ method_field('put') }}
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="reply"></textarea>

                                                                    <input type="file" name="file_reply"  class="form-control" >
                                                                </div>

                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-success" value="@lang('site.add_reply')" />
                                                                    </div>

                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                            </div>


                        </div>
                    </div>




                <div class="form-group">


                    @if (auth()->user()->hasPermission('update_Supportcalls'))

                        @if ($ticket->status != 'solved')

                        <form action="{{route('dashboard.tickets.update', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-group">
                                <label> @lang('site.external_ticket_id') </label>
                                <input type="text" name="external_ticket_id"  class="form-control" >
                            </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="@lang('site.add')" />
                                </div>

                        </form>

                            <form action="{{route('dashboard.tickets.update', $ticket->id)}}" method="POST" style="display: inline-block">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="is_solved" value="1">
                                <button type="submit" class="form-control btn btn-info btn-sm edit" style="margin-bottom:7px;width:83px"> <i class="fa fa-edit"></i> @lang('site.close')</button>
                            </form>

                        @endif



                    @endif


                </div>
            </form>

            </div><!-- end of box body -->
        </div>
    </section>

</div>


@endsection
