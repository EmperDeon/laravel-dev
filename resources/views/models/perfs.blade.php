@extends('template.index')

@section('content')
    <h2>Репертуар </h2> @include('part.perf-types')
    @foreach($perfs as $perf)
        <div class="perf-info col-sm-4">
            <a href="/performances/{{ $perf->id }}">
                <img src="/img/{{ $perf->img }}" />
                {{ $perf->perf->name }}
            </a><br />
            <a href="/theatres/{{ $perf->theatre_id }}" style="font-size: 10pt">{{ $perf->theatre->name }}</a>
            <p>
                {{ $perf->perf->type->name }} <br />
                {{ $perf->desc_s }}
            </p>
            @lang('global.lorem-s')
            <br style="clear: both" />
        </div>
    @endforeach

@stop

