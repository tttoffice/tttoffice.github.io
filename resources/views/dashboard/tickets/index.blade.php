@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.tickets')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}">  <i class="fa fa-dashboard"> </i> @lang('site.dashboard') </a> </li>
        <li class="active">  </i> @lang('site.tickets')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                 <h3 class="box-title" style="margin-bottom: 15px">@lang('site.tickets') <small>{{$tickets->total()}}</small></h3>


            </div>
            <div class="box-body table-responsive">
              @if ($tickets->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('site.code')</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.priority')</th>
                                <th>@lang('site.reference_call')</th>
                                <th>@lang('site.status')</th>
                                <th>@lang('site.created_at')</th>
                                <th>@lang('site.view')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $index=>$ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->priority }}</td>
                                    <td>{{ $ticket->reference_call }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>{{ is_null($ticket->created_at) ?'':$ticket->created_at->toDayDateTimeString() }}</td>

                                    <td>
                                        <a href="tickets/{{$ticket->id}}"  class="form-control btn btn-info btn-sm edit" style="margin-bottom:7px;width:83px"  > <i class="fa fa-edit"></i> @lang('site.show') </a>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- end of table -->
                    {{-- links() to run paginate from ticketscontroller , appends(request()->query) da 3lshan yafdal append key of search mat3'yrash m3a links --}}
                    {{$tickets->appends(request()->query())->links()}}

              @else
                  <h2>@lang('site.no_data_found')</h2>
              @endif
            </div><!-- end of box body -->
        </div>
    </section>

</div>


@endsection
