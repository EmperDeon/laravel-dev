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
                            <li><a href="/posters?by_type={{$type->id}}">{{$type->name}}</a></li>
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
                    <a href="/theatres/" data-hover="dropdown" class="dropdown-toggle">@lang('global.theatres') <b class="nav-caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        @foreach($theatres as $theatre)
                            <li><a tabindex="-1" href="/theatres/{{ $theatre->id }}"> {{$theatre->name}}</a></li>
                        @endforeach
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
