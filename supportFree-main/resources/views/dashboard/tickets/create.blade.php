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
               <form action="{{ route('dashboard.tickets.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <label> @lang('site.projectName') </label>
                        <input type="text" disabled class="form-control" value="{{ auth()->user()->project->title }} ">
                    </div>

                    <div class="form-group">
                        <label> @lang('site.branchName') </label>
                        <input type="text" disabled class="form-control" value="{{ auth()->user()->branch->title }} ">
                    </div>

                    <div class="form-group">
                        <label> @lang('site.username') </label>
                        <input type="text" disabled class="form-control" value="{{ auth()->user()->firstName }} {{ auth()->user()->lastName }} ">
                    </div>
                    <div class="form-group">
                        <label> @lang('site.email') </label>
                        <input type="text" disabled class="form-control" value="{{ auth()->user()->email }} ">
                    </div>



                    <div class="form-group">
                        <label > @lang('site.modules') </label>
                        <select name="module_id" class="form-control" >
                            <option value="">@lang('site.select_module')</option>
                            @foreach ($modules as $module)
                        <option value=" {{$module->id}}" {{ old('module_id') == $module->id ? 'selected' : ''}}>{{$module->title}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label > @lang('site.priorities') </label>
                        <select name="priority" class="form-control" >
                            <option value="low">@lang('site.low')</option>
                            <option value="medium">@lang('site.medium')</option>
                            <option value="high">@lang('site.high')</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label> @lang('site.reference_call') </label>
                        <input type="text" name="reference_call" class="form-control" value="{{ old('reference_call') }} ">
                    </div>
                    <div class="form-group">

                        <div class="nav-tabs-custom">
                            @php
                                $models=['TicketDetails','Attachments'];

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
                                            <input type="text" name="title" class="form-control" value="{{ old('title') }} " >
                                        </div>

                                        <div class="form-group">
                                            <label> @lang('site.description') </label>

                                            <textarea name="description" class="form-control" cols="30" rows="10"   ></textarea>
                                        </div>

                                    </div>

                                    <div class="tab-pane  " id="Attachments">

                                        <label> @lang('site.select_files') </label>
                                        <input type="file" name="file1"  class="form-control" >
                                        <input type="file" name="file2"  class="form-control" >

                                    </div>


                            </div>


                        </div>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('site.create') </button>
                    </div>
                </form>

            </div><!-- end of box body -->
        </div>
    </section>

</div>


@endsection
