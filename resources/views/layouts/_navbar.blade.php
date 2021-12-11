<nav class="{{Auth::user()->role === "STUDENT" && Request::is('student/subject/*/course/*/topic/*/*') ? 'navbar navbar-expand-sm top-navbar w-100' : 'navbar navbar-expand-sm top-navbar'}}">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <!-- <a href="{{route('dashboard')}}">
                    <img src="{{asset('assets/images/logo-learnifyid.svg')}}" alt="Smart School Logo" width="150px">
                </a> -->
                    <button type="button" class="btn-toggle-offcanvas pt-md-2 pt-0"><i class="{{Auth::user()->role === "STUDENT" && Request::is('student/subject/*/course/*/topic/*/*') ? 'd-none' : 'lnr lnr-menu fa fa-bars'}}"></i></button>
            </div>
            <ul class="nav navbar-nav pl-0">
                @if (Auth::user()->role === "STUDENT")
                    <li>
                        @include('layouts.student._nav_menu')
                    </li>
                @endif
            </ul>
        </div>
        
        <div class="navbar-right d-sm-flex d-block">
            <div id="menu-nav">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-bell"></i>

                        </a>
                        <ul class="dropdown-menu feeds_widget vivify fadeIn notif">
                            <li class="header blue">Notifications</li>
                            @foreach(DB::table('notif')->where('student_id', Auth::id() )->get() as $item)
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="feeds-left bg-info"><i class="fa fa-user"></i></div>
                                    <div class="feeds-body">
                                        <h4 class="title text-info">{{$item->title}}<small class="float-right text-muted"></small></h4>
                                        <small>{{$item->message}}</small>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </li>
                    <li><a href="#" class="icon-menu js-sweetalert" data-type="confirm-logout" data-toggle="tooltip" data-placement="bottom" title="Keluar"><i class="icon-power"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
</nav>