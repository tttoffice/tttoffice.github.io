@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.branches')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}">  <i class="fa fa-dashboard"> </i> @lang('site.dashboard') </a> </li>
        <li class="active">  </i> @lang('site.branches')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                 <h3 class="box-title" style="margin-bottom: 15px">@lang('site.branches') <small>{{$branches->total()}}</small></h3>

                <form action="{{route('dashboard.branches.index')}}" method="GET">

                    <div class="row">

                        <div class="col-md-4">
                              <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                        </div>

                        <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"> <li class="fa fa-search"></li> @lang('site.search') </button>
                                @if (auth()->user()->hasPermission('create_branches'))
                                      <a href="{{ route('dashboard.branches.create') }}" class="btn btn-primary"> <li class="fa fa-plus"></li> @lang('site.add') </a>
                                @else
                                <a href="#" class="btn btn-primary disabled"> <li class="fa fa-plus"></li> @lang('site.add') </a>
                                @endif

                        </div>

                    </div>

                </form>
            </div>
            <div class="box-body table-responsive">

              @if ($branches->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.local_title')</th>
                                <th>@lang('site.content')</th>
                                <th>@lang('site.local_content')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $index=>$branch)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $branch->translate('en')->title}}</td>
                                    <td>{{ $branch->translate('ar')->title}}</td>
                                    <td>{{ $branch->translate('en')->content}}</td>
                                    <td>{{ $branch->translate('ar')->content}}</td>

                                    <td>
                                    @if (auth()->user()->hasPermission('update_branches'))
                                         <a href=" {{route('dashboard.branches.edit' , $branch->id)}} "  class="form-control btn btn-info btn-sm edit" style="margin-bottom:7px;width:83px"  > <i class="fa fa-edit"></i> @lang('site.edit') </a>

                                    @else
                                         <a href="#" class="btn btn-info btn-sm disabled"> <i class="fa fa-edit"></i> @lang('site.edit') </a>
                                    @endif
                                    @if (auth()->user()->hasPermission('update_branches'))
                                            <form action="{{route('dashboard.branches.update', $branch->id)}}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <input type="hidden"  name="status" value="hide">
                                                <button type="submit" class="form-control btn btn-danger btn-sm delete" style="margin-bottom:7px;width:83px" >  <i class="fa fa-trash"></i> @lang('site.hide')</button>
                                           </form>
                                    @else
                                           <button class="btn btn-danger  btn-sm disabled"> <i class="fa fa-trash"></i> @lang('site.hide') </button>
                                    @endif

                                    @if (auth()->user()->hasPermission('update_branches'))
                                            <form action="{{route('dashboard.branches.update', $branch->id)}}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <input type="hidden"  name="status" value="unhide">
                                                <button type="submit" class="form-control btn btn-info btn-sm edit" style="margin-bottom:7px;width:83px" >  <i class="fa fa-edit"></i> @lang('site.unhide')</button>
                                           </form>
                                    @else
                                           <button class="btn btn-danger  btn-sm disabled"> <i class="fa fa-trash"></i> @lang('site.unhide') </button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- end of table -->
                    {{-- links() to run paginate from branchescontroller , appends(request()->query) da 3lshan yafdal append key of search mat3'yrash m3a links --}}
                    {{$branches->appends(request()->query())->links()}}

              @else
                  <h2>@lang('site.no_data_found')</h2>
              @endif
            </div><!-- end of box body -->
        </div>
    </section>

</div>


@endsection
