<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('uploads/users_images/default.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            @if (auth()->user()->hasRole('super_admin'))
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_users'))
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Admin</li>
                    <!-- Optionally, you can add icons to the links -->

                    <li class="active"><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-link"></i><span>@lang('site.users_management')</span></a></li>

                    @if (auth()->user()->hasPermission('read_projects'))
                    <li class="active"><a href="{{ route('dashboard.projects.index') }}"><i class="fa fa-link"></i><span>@lang('site.projects')</span></a></li>
                    @endif
                    @if (auth()->user()->hasPermission('read_modules'))
                    <li class="active"><a href="{{ route('dashboard.modules.index') }}"><i class="fa fa-link"></i><span>@lang('site.modules')</span></a></li>
                    @endif

                    @if (auth()->user()->hasPermission('read_branches'))
                    <li class="active"><a href="{{ route('dashboard.branches.index') }}"><i class="fa fa-link"></i><span>@lang('site.branches')</span></a></li>
                    @endif

                </ul>

            @endif

            @if (auth()->user()->hasPermission('read_employees'))
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Editor</li>
                    <!-- Optionally, you can add icons to the links -->

                    <li class="active"><a href="{{ route('dashboard.employees.index') }}"><i class="fa fa-link"></i><span>@lang('site.employees_management')</span></a></li>


                    @if (auth()->user()->hasPermission('read_Supportcalls'))

                    <li class="active"><a href="{{ route('dashboard.allcalls') }}"><i class="fa fa-link"></i><span>@lang('site.allcalls')</span></a></li>
                    <li class="active"><a href="{{ route('dashboard.allpendingcalls') }}"><i class="fa fa-link"></i><span>@lang('site.allpendingcalls')</span></a></li>
                    <li class="active"><a href="{{ route('dashboard.allcloasedcalls') }}"><i class="fa fa-link"></i><span>@lang('site.allcloasedcalls')</span></a></li>
                    {{-- <li class="active"><a href="{{ route('dashboard.tickets.index') }}"><i class="fa fa-link"></i><span>@lang('site.action ')</span></a></li> --}}

                    @endif



                </ul>
            @endif




            {{-- calls == tickets --}}

            <ul class="sidebar-menu" data-widget="tree">

                @if (auth()->user()->hasPermission('read_calls'))
                <li class="header">calls</li>
                    <li class="active"><a href="{{ route('dashboard.search') }}"><i class="fa fa-link"></i><span>@lang('site.search')</span></a></li>
                    <li class="active"><a href="{{ route('dashboard.tickets.index') }}"><i class="fa fa-link"></i><span>@lang('site.mycalls')</span></a></li>
                    <li class="active"><a href="{{ route('dashboard.pendingcalls') }}"><i class="fa fa-link"></i><span>@lang('site.pendingcalls')</span></a></li>
                    <li class="active"><a href="{{ route('dashboard.cloasedcalls') }}"><i class="fa fa-link"></i><span>@lang('site.cloasedcalls')</span></a></li>

                @endif

                @if (auth()->user()->hasPermission('create_calls'))
                         <li class="active"><a href="{{ route('dashboard.tickets.create') }}"><i class="fa fa-link"></i><span>@lang('site.opencall')</span></a></li>
                @endif
            </ul>


            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Logout</li>

                <li class="active">


                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">@lang('site.logout')</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                </li>

            </ul>







            {{--
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>الخرائط</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
            {{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>

    </section>

</aside>
