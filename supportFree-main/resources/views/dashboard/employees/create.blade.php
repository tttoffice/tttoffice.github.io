@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>
            @lang('site.employees')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}"> <i class="fa fa-dashboard">     </i> @lang('site.dashboard') </a> </li>
        <li> <a href="{{  route('dashboard.employees.index') }}">  @lang('site.employees') </a> </li>
        <li class="active">   </i> @lang('site.add')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                <h3 class="box-title">@lang('site.add')</h3>

            </div>
            <div class="box-body">
                @include('partials._errors')
               <form action="{{ route('dashboard.employees.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="form-group">
                        <label> @lang('site.first_name') </label>
                        <input type="text" name="firstName" class="form-control" value="{{ old('firstName') }} " >
                    </div>

                    <div class="form-group">
                        <label> @lang('site.last_name') </label>
                        <input type="text" name="lastName" class="form-control" value="{{ old('lastName') }} ">
                    </div>
                    <div class="form-group">
                        <label> @lang('site.email') </label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }} ">
                    </div>

                    <div class="form-group">
                        <label > @lang('site.projects') </label>
                        <select name="project_id" class="form-control" >
                            <option value="">@lang('site.select_project')</option>
                            @foreach ($projects as $project)
                        <option value=" {{$project->id}}" {{ old('project_id') == $project->id ? 'selected' : ''}}>{{$project->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label > @lang('site.branches') </label>
                        <select name="branch_id" class="form-control" >
                            <option value="">@lang('site.select_branch')</option>
                            @foreach ($branches as $branch)
                        <option value=" {{$branch->id}}" {{ old('branch_id') == $branch->id ? 'selected' : ''}}>{{$branch->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label> @lang('site.image') </label>
                        <input type="file" name="image" class="form-control image" >
                    </div>
                    <div class="form-group">
                        <img src="{{ asset('uploads/users_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div>
                    <div class="form-group">
                        <label> @lang('site.password') </label>
                        <input type="password" name="password" class="form-control"  >
                    </div>
                    <div class="form-group">
                        <label> @lang('site.password_confirmation') </label>
                        <input type="password" name="password_confirmation" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>@lang('site.permissions')</label>
                        <div class="nav-tabs-custom">
                            @php
                                //  $models=['profile','calls'];
                                $models=['calls'];
                                $maps=['create','read','update','delete'];
                            @endphp
                            <ul class="nav nav-tabs">

                                @foreach ($models as $index=>$model)
                                    <li class="{{ $index == 0 ? 'active' : '' }}"> <a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a> </li>
                                @endforeach

                            </ul>

                            <div class="tab-content">

                                @foreach ($models as $index=>$model)

                                    <div class="tab-pane {{ $index == 0 ? 'active' : ''}} " id="{{$model}}">

                                        @foreach ($maps as $map)
                                            <label><input type="checkbox" name="permissions[]" value="{{$map}}_{{$model}}">@lang('site.'.$map)</label>
                                        @endforeach

                                    </div>
                                @endforeach

                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.add') </button>
                    </div>
                </form>

            </div><!-- end of box body -->
        </div>
    </section>

</div>


@endsection
