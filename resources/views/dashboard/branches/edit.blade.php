@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">


        <h1>
            @lang('site.branches')
        </h1>

        <ol class="breadcrumb">
        <li> <a href="{{  route('dashboard.index') }}"> <i class="fa fa-dashboard">     </i> @lang('site.dashboard') </a> </li>
        <li> <a href="{{  route('dashboard.branches.index') }}">  @lang('site.branches') </a> </li>
        <li class="active">   </i> @lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">

            <div class="box-header with-boarder ">
                <h3 class="box-title">@lang('site.edit')</h3>

            </div>
            <div class="box-body">
                @include('partials._errors')

               <form action="{{ route('dashboard.branches.update' , $branch->id)}}" method="POST" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    {{-- get data from config\translatable--}}
                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            {{-- like site.ar.name--}}
                            <label> @lang('site.'.$locale.'.title') </label>
                            {{--ar[name]--}}
                            <input type="text" name="{{$locale}}[title]" class="form-control" value="{{$branch->translate($locale)->title}} " >
                        </div>

                        <div class="form-group">
                            {{-- like site.ar.name--}}
                            <label> @lang('site.'.$locale.'.content') </label>
                            {{--ar[name]--}}
                            <input type="text" name="{{$locale}}[content]" class="form-control" value="{{$branch->translate($locale)->content}} " >
                        </div>

                    @endforeach


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-edit"></i> @lang('site.edit') </button>
                    </div>
                </form>

            </div>
        </div>
    </section>

</div>


@endsection
