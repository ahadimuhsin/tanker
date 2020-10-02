{{-- Topbar --}}
<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular" onclick="decrease()">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini" onclick="increase()">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
{{--            <a class="navbar-brand" href="#"> Dashboard </a>--}}
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="material-icons">account_circle</i>
                        @if(\Auth::user())
                            {{\Auth::user()->username}}
                        @endif
                        <p class="hidden-lg hidden-md">
                            Notifications
                            <b class="caret"></b>
                        </p>
                        <div class="ripple-container"></div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url('logout')}}"><i class="material-icons">exit_to_app</i> Logout</a>
                        </li>
                    </ul>
                </li>
                <li class="separator hidden-lg hidden-md"></li>
            </ul>
        </div>
    </div>
</nav>
