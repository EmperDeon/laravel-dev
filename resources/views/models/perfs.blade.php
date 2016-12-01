@extends('template.index')

@section('content')
    <h2>Репертуар @include('part.perf-types') </h2>
    @forelse($perfs as $perf)
        <div class="perf-small col-sm-4">
            <a href="/performances/{{ $perf->id }}">
                <img src="/img/{{ $perf->img }}" />
                {{ $perf->perf->name }}
            </a><br />
            <a href="/theatres/{{ $perf->theatre_id }}" style="font-size: 10pt">{{ $perf->theatre->name }}</a>
            <p>
                {{ $perf->desc_s }}
            </p>
            @lang('global.lorem-s')
            <br style="clear: both" />
        </div>
        @empty
            <tr>
                <td>
                    <h3>Нет представлений по данным критериям</h3>
                </td>
            </tr>
        @endforelse

@stop

