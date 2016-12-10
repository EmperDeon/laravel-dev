@extends('template.index')

@section('content')
    <h2>Афиша</h2>
    @include('part.perf-types')

    <table class="posters-table">
    @forelse($posters as $poster)
        <tr>
            <td class="date">
                {{ Date::parse($poster->date)->format('d F Y, l') }}
            </td>
            <td class="name">
            <a href="/posters/{{ $poster->t_perf->id }}">
                {{ $poster->t_perf->perf->name }}
            </a><br />
            <a href="/theatres/{{ $poster->t_perf->theatre_id }}" style="font-size: 10pt">{{ $poster->t_perf->theatre->name }}</a>
            <a href="#" style="font-size: 8pt">{{ $poster->hall->name }}</a>


            </td>
            <td class="time">
                {{ Date::parse($poster->date)->format('G:i') }}
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

