<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">@lang('global.site-name')</a>
        </div>
        <div id="navbar-collapse-1" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="/posters/" data-hover="dropdown" class="dropdown-toggle">@lang('global.posters') <b class="nav-caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        @foreach($p_types as $type)
                            <li><a href="/posters/by_type/{{$type->id}}">{{$type->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="/performances/" data-hover="dropdown" class="dropdown-toggle">@lang('global.perfs') <b class="nav-caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        @foreach($p_types as $type)
                            <li><a href="/performances?by_type={{$type->id}}">{{$type->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="/articles/" data-hover="dropdown" class="dropdown-toggle">@lang('global.news') <b class="nav-caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a tabindex="-1" href="#"> Action </a></li>
                    </ul>
                </li>
                {{--<li class="dropdown">--}}
                    {{--<a href="/theatres/" data-hover="dropdown" class="dropdown-toggle">@lang('global.theatres') <b class="nav-caret"></b></a>--}}
                    {{--<ul role="menu" class="dropdown-menu">--}}
                        {{--@foreach($theatres as $theatre)--}}
                            {{--<li><a tabindex="-1" href="/theatres/{{ $theatre->id }}"> {{$theatre->name}}</a></li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</li>--}}

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-globe"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a tabindex="-1" href="#"> Русский </a></li>
                        <li><a tabindex="-1" href="#"> English </a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-adjust"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a tabindex="-1" href="#"> @lang('global.theme-light') </a></li>
                        <li><a tabindex="-1" href="#"> @lang('global.theme-dark') </a></li>
                    </ul>
                </li>

                @if(Auth::check())
                    <li class="dropdown">
                        <a href="/user/" data-hover="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-home"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a tabindex="-1" href="#"> </a></li>
                            <li><a tabindex="-1" href="/auth/logout"> @lang('auth.logout') </a></li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="#loginModal" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> @lang('auth.log-in')</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-sm modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/login', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="email"><span class="glyphicon glyphicon-user"></span> Login</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter login">
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="text" class="form-control" id="password" placeholder="Enter password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked>Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <p>Not a member? <a href="#">Sign Up</a></p>
                <p>Forgot <a href="#">Password?</a></p>
            </div>
        </div>

    </div>
</div>