@extends('template.index')

@section('content')
    <h2>Афиша @include('part.perf-types')</h2>

    <table class="posters-table">
    @forelse($posters as $poster)
        <tr>
            <td class="date">
                {{ \Carbon\Carbon::parse($poster->date)->formatLocalized('%d %B %Y') }}
            </td>
            <td class="name">
            <a href="/posters/{{ $poster->t_perf->id }}">
                {{ $poster->t_perf->perf->name }}
            </a><br />
            <a href="/theatres/{{ $poster->t_perf->theatre_id }}" style="font-size: 10pt">{{ $poster->t_perf->theatre->name }}</a>


            </td>
            <td class="time">
                {{ \Carbon\Carbon::parse($poster->date)->formatLocalized('%R') }}
            </td>
        </tr>
    @empty
        <tr>
            <td>
                <h3>Нет представлений по данным критериям</h3>
            </td>
        </tr>
    @endforelse
    </table>
@stop

