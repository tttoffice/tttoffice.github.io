@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.employees')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}">  <i class="fa fa-dashboard"> </i> @lang('site.dashboard') </a> </li>
        <li class="active">  </i> @lang('site.employees')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                 <h3 class="box-title" style="margin-bottom: 15px">@lang('site.employees') <small>{{$employees->total()}}</small></h3>

                <form action="{{route('dashboard.employees.index')}}" method="GET">

                    <div class="row">

                        <div class="col-md-4">
                              <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                        </div>

                        <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"> <li class="fa fa-search"></li> @lang('site.search') </button>
                                @if (auth()->user()->hasPermission('create_employees'))
                                      <a href="{{ route('dashboard.employees.create') }}" class="btn btn-primary"> <li class="fa fa-plus"></li> @lang('site.add') </a>
                                @endif

                        </div>

                    </div>

                </form>
            </div>
            <div class="box-body table-responsive">
              @if ($employees->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>user code</th>
                                <th>@lang('site.full_name')</th>

                                <th>@lang('site.email')</th>
                                <th>@lang('site.branch')</th>
                                {{-- <th>@lang('site.all_tickets')</th>
                                <th>@lang('site.open_tickets')</th> --}}

                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $index=>$employee)
                                <tr>
                                    <td>{{ $employee->id}}</td>
                                    <td>{{ $employee->firstName }} {{ $employee->lastName }}</td>

                                    <td>{{ $employee->email }}</td>

                                    <td>{{ $employee->branch->title ?? ""}}</td>
{{--
                                    <td>{{$employee->tickets->count() >0 ? $employee->tickets->total() : 0 }}</td>
                                    <td>{{$employee->tickets->count() >0 ? $employee->tickets->where('status','!=','solved')->total() : 0 }}</td>
 --}}


                                    <td>
                                    @if (auth()->user()->hasPermission('update_employees'))
                                         <a href=" {{route('dashboard.employees.edit' , $employee->id)}} "  class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit') </a>

                                    @endif
                                    @if (auth()->user()->hasPermission('delete_employees'))
                                            <form action="{{route('dashboard.employees.destroy', $employee->id)}}" method="POST" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger btn-sm delete" >  <i class="fa fa-trash"></i>@lang('site.delete')</button>
                                           </form>

                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- end of table -->
                    {{-- links() to run paginate from employeescontroller , appends(request()->query) da 3lshan yafdal append key of search mat3'yrash m3a links --}}
                    {{$employees->appends(request()->query())->links()}}

              @else
                  <h2>@lang('site.no_data_found')</h2>
              @endif
            </div><!-- end of box body -->
        </div>
    </section>

</div>


@endsection
